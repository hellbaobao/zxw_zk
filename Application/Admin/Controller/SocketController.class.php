<?php

/**
 * @name ActionlogController
 * @info 描述：操作日志控制器
 * @author Hellbao <1036157505@qq.com>
 * @datetime 2017-2-7 14:02:04
 */

namespace Admin\Controller;

use Think\Controller;

class SocketController extends BaseDBController {

    public function _initialize() {
        parent::_initialize();
    }

    public function handAction() {
        $this->display();
    }

}
