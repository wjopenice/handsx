<?php

    namespace app\index\controller;

    use app\common\controller\Base;
    use think\Config;

    class Index extends Base {
        /**
         * 首页
         * @return mixed
         * @throws \think\db\exception\DataNotFoundException
         * @throws \think\db\exception\ModelNotFoundException
         * @throws \think\exception\DbException
         */
        public function index() {

            /*if(isMobile()){
                header("Location:/mobile");
            }*/

            $id = session('promote_auth')['id'];

            //获取商户数据信息
            $data = getProData();

            //最新公告
            $notice = db('hands_notice')->order('id desc')->select();

            //登录记录
            $logs = db('promote_logs')
                ->alias('l')
                ->field('l.*,p.account')
                ->join('promote p','p.id=l.pid')
                ->where("l.pid=".$id." and l.identity=1")
                ->limit('8')
                ->order('l.id desc')
                ->select();
            foreach ($logs as $key=>$val) {
                $logs[$key]['time'] = date('Y-m-d H:i:s',$val['time']);
            }

            $this->assign('data',$data);
            $this->assign('notice',$notice);
            $this->assign('logs',$logs);

            return $this->fetch();
        }

        //公告详情
        public function notData(){
            $id = input('get.id');
            $find = db('hands_notice')->where('id ='.$id)->find();
            $find['ctime'] = $find['ctime'] ? date('Y-m-d H:i:s',$find['ctime']) : '';

            $this->assign('find',$find);
            return $this->fetch();
        }

        public function complaintPic() {
            if (!request()->isPost()) {
                $this->redirect('/');
            } else {
                //$data   = input('post.');
                $avatar = request()->file('se_upload');
                file_put_contents('img', $avatar);
                //var_dump($avatar);exit;
                if (!empty($avatar)) {
                    $file_path = DATA_PATH . 'uploads/complaint';
                    if (!is_dir($file_path)) {
                        mkdir($file_path, 0777, true);
                    }
                    $info = $avatar->move($file_path);
                    if ($info) {
                        $fileSave = $info->getSaveName();
                        $row      = '/data/uploads/complaint/' . str_replace('\\', "/", $fileSave);
                        //var_dump($row);exit;
                        echo json_encode([
                                             'url' => $row,
                                             'msg' => '上传成功'
                                         ]
                        );
                    } else {
                        $err = $avatar->getError();
                        echo json_encode(['msg' => '上传失败']);;
                    }
                }
            }
        }
    }