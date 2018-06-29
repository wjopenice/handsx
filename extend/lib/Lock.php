<?php
    /**
     *  Author : Luo
     *  Encoding : UTF-8
     *  Separator : Unix and OS X (\n)
     *  File Name : Lock.php
     *  Create Date : 2017/8/28 10:46
     *  Version : 0.1
     *  Email Address : Luo@126.com
     */

    namespace lib;
    class Lock {
        /**
         * 琐定状态
         * @param int $userNum
         * @param int $type
         * @param     $time
         * @return mixed|null
         */
        public function isLock(int $userNum, int $type = 0, $time ) {
            if (empty($userNum)) {
                return null;
            }
            $lockType = db('member_lock')->where('`user_num`=' . $userNum . ' and `type`=' . $type . ' and `status` = 1')->find();
            if (!empty($lockType)) {
                if ($lockType['lock_time'] < $time && $lockType['unlock_time'] > $time) {
                    return $lockType['unlock_time'];
                } else {
                    db('member_lock')->where('`id`=' . $lockType['id'])->update(['lock_time'   => 0,
                                                                                 'unlock_time' => 0,
                                                                                 'status'      => 0,
                                                                                 'failure'     => 0
                                                                                ]
                    );
                    return null;
                }
            } else {
                return null;
            }
        }

        /**
         * 琐定用户操作
         * @param int $userNum
         * @param int $type
         * @return int|null|string
         */
        public function onLock(int $userNum, int $type = 0) {
            if (empty($userNum)) {
                return null;
            }
            $nowTime = time();
            $lock    = db('member_lock')->where('`user_num`=' . $userNum . ' and `type`=' . $type)->find();
            if (!empty($lock)) {
                $lockTime = [
                    'lock_time'   => $nowTime,
                    'unlock_time' => $nowTime + 1200 * 0.5,
                    'status'      => 1,
                    'failure'     => $lock['failure'] + 1,
                    'lock_num'    => 0.5
                ];
                if ($lock['failure'] >= 2) {
                    $result = db('member_lock')->where('`id`=' . $lock['id'])->update($lockTime);
                    return $lockTime['unlock_time'];
                } else {
                    $result = db('member_lock')->where('`id`=' . $lock['id'])->setInc('failure', 1);
                    return null;
                }
            } else {
                $dataTime = [
                    'user_num' => $userNum,
                    'type'     => $type,
                    'failure'  => 1
                ];
                $result   = db('member_lock')->insertGetId($dataTime);
                return null;
            }
        }
    }