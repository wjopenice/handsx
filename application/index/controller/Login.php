<?php

    namespace app\index\controller;

    use app\index\model\Promote;
    use lib\Api;
    use lib\Encryption;
    use lib\Sms;
    use lib\SmsHx;
    use think\Controller;
    use lib\Check;
    use think\Config;
    use think\Log;

    class Login extends Controller {
        const DATA_AUTH_KEY = 'oq0d^*AcXB$-2[]PkFaKY}eR(Hv+<?g~CImW>xyV';

        public function index() {
            return $this->fetch();
        }

        /**
         * 登录操作
         * @throws \think\Exception
         * @throws \think\db\exception\DataNotFoundException
         * @throws \think\db\exception\ModelNotFoundException
         * @throws \think\exception\DbException
         * @throws \think\exception\PDOException
         */
        public function login() {

//            if(isMobile()){
//                header("Location:/mobile");
//            }

            if($_POST){
                $account  = input('post.account');
                $password = input('post.password');
                $map['account'] = $account;

                /* 获取用户数据 */
                $field = "id,account,hands_pass,nickname,mobile_phone,money,total_money,status,identity";
                $user = db('promote')->field($field)->where($map)->find();

                if(is_array($user) && $user['status'] && $user['identity']){
                    /* 验证用户密码 */

                    if(($this->think_ucenter_md5($password, self::DATA_AUTH_KEY)) === $user['hands_pass']){
                        rwLog(array(
                            'content' => '登录商户平台',
                            'login_ip' => get_server_ip(),
                            'time'   => time(),
                            'pid'   => $user['id'],
                        ));
                        $lifetime           = 1800;
                        session_set_cookie_params($lifetime);
                        session_start();
                        session('promote_auth', $user);
                        session('isLogin', 1);
                        echo json_encode([
                                'msg'     => '登录成功',
                                'success' => '1'
                            ]
                        );
                        exit;
                    } else {
                        //return -2; //密码错误
                        echo json_encode([
                                'msg'     => '密码错误',
                                'error' => '1'
                            ]
                        );
                        exit;
                    }
               } else {
                   //return -1; //商户不存在或被禁用
                   echo json_encode([
                           'msg'     => '商户不存在或被禁用',
                           'error' => '1'
                       ]
                   );
               }
            }else{
                return $this->fetch();
            }

        }

        //密码加密
        public function think_ucenter_md5($str, $key = 'ThinkUCenter'){
            return '' === $str ? '' : md5(sha1($str) . $key);
        }


        //退出
        public function logout() {
            session(null);
            $this->redirect('/index.html');
        }

        //判断用户是否登陆
        public function isLogin() {
            if (empty(session('user'))) {
                $this->error('用户未登陆', '/login');
            } else {
                $this->success('用户已登陆');
            }
        }

        /**
         * 找回密码
         */
        public function forgetPwd() {
            return $this->fetch();
        }

        /**
         * 找回密码
         * @return bool
         * @throws \think\Exception
         * @throws \think\db\exception\DataNotFoundException
         * @throws \think\db\exception\ModelNotFoundException
         * @throws \think\exception\DbException
         * @throws \think\exception\PDOException
         */
        public function findPassword() {
            if (!request()->isAjax()) {
                return false;
            } else {
                $phone    = input('post.phone');
                $code     = input('post.code');
                $newPwd   = input('post.new_pwd');
                $checkPwd = input('post.check_pwd');
                $type     = input('post.type');
                //var_dump($type);exit;
                $user     = db('member')->where("`phone`='{$phone}'")->find();
                $msmToken = session('phoneCode');
                if (empty($user)) {
                    $this->error('你还没注册过');
                }
                if (empty($msmToken) || intval($code) !== intval($msmToken)) {
                    $this->error('请先获取验证码,或验证码错误');
                }
                if (intval($type) === 0) {

                    if (empty($code)) {
                        $this->error('请先获取验证码');
                    }
                    $this->success('验证成功', '', [
                                             'phone' => $phone,
                                             'code'  => $code
                                         ]
                    );
                }
                if (intval($type) === 1) {

                    if ($newPwd !== $checkPwd) {
                        $this->error('两次密码不一至');
                    }
                    session('phoneCode', null);
                    $newPassword = $phone . '#' . $newPwd;
                    $nData       = [
                        'encryption_pass' => $newPwd,
                        'password'        => password_hash($newPassword, PASSWORD_DEFAULT)
                    ];
                    $row         = db('member')->where('`member_id`=' . $user['member_id'])->update($nData);
                    if (!empty($row)) {
                        $this->success('找回密码成功,请使用新密码登陆');
                    } else {
                        $this->error('密码找回失败');
                    }
                }
            }
        }

        /**
         * 发送短信
         * @return bool
         */
        public function getPhoneCode() {
            if (!request()->isAjax()) {
                return false;
            } else {
                $phone = input('post.phone_r');
                $code  = rand(100000, 999999);
                session('phone_code', $code);
                $response = (new Sms())->sendSms("皇玉阁", "SMS_119785003", $phone, [  // 短信模板中字段的值
                                                                                   "code"    => $code,
                                                                                   "product" => "dsd"
                ]
                );
                Log::write($response,'info');
                $result = json_decode(json_encode($response),TRUE);
                if (!empty($result) && $result['Code'] === 'OK') {
                    $this->success('发送成功');
                } else {
                    $this->error('发送失败');
                }
            }
        }

        /**
         * 找回密码发送短息
         * @throws \think\db\exception\DataNotFoundException
         * @throws \think\db\exception\ModelNotFoundException
         * @throws \think\exception\DbException
         */
        public function smsPhoneCode() {
            $phone   = input('post.phone');
            $code    = input('post.code');
            $captcha = (array)Config::get('captcha');//配置验证对象
            if (!captcha_check($code, 'login', $captcha)) {
                $this->error('验证码错误');
            }
            $user = db('member')->where("`phone`='{$phone}'")->find();
            if (empty($user)) {
                $this->error('你还没注册过');
            }
            $phoneCode = rand(000000, 999999);
            session('phoneCode', $phoneCode);
            $result = Sms::sendSms('皇玉阁', 'SMS_119785002', $phone, [
                                           'code'    => $phoneCode,
                                           'product' => 'dsd'
                                       ]
            );
            //var_dump($result);exit;
            $result = json_decode(json_encode($result),TRUE);
            if (!empty($result) && $result['Code'] === 'OK') {
                $this->success('发送成功');
            } else {
                $this->error('发送失败');
            }
        }
    }
