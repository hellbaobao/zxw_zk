<?php

/**
 * @name ApptController
 * @info 描述：预约管理操作控制器
 * @author Hellbao <1036157505@qq.com>
 * @datetime 2018-08-09 14:57:46
 */

namespace Home\Controller;

use Think\Controller;

header('Access-Control-Allow-Origin:*');  //支持全域名访问，不安全，部署后需要固定限制为客户端网址
header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE'); //支持的http 动作
header('Access-Control-Allow-Headers:x-requested-with,content-type');  //响应头 请按照自己需求添加。

class ApptController extends Controller {

    /**
     * -------------------------------------------------------------------------
     * 前台接口
     * -------------------------------------------------------------------------
     */
    public function visitOrder() {
        $this->assign('key', 'wx');
        $this->display();
    }

    /**
     * -------------------------------------------------------------------------
     * 数据接口
     * -------------------------------------------------------------------------
     */
    public function addVisitOrder() {

        $closeCount = M('appt_visit_close')->where(['close_time' => $_POST['appt_time']])->count();

        if ($closeCount > 0) {
            $return['flag'] = 0;
            $return['msg'] = "该日闭馆，请选择其他日期！";
            $this->ajaxReturn($return, 'JSON');
        }
        $flag = M('appt_visit_info')->add($_POST);
        if ($flag > 0) {
            $return['flag'] = 1;
        } else {
            $return['flag'] = 0;
            $return['msg'] = "数据插入失败！";
        }
        $this->ajaxReturn($return, 'JSON');
    }

    public function addLearnOrder() {
        $flag = M('appt_learn_order')->add($_POST);
        if ($flag > 0) {
            $return['flag'] = 1;
        } else {
            $return['flag'] = 0;
            $return['msg'] = "数据插入失败！";
        }
        $this->ajaxReturn($return, 'JSON');
    }

    public function learn_list() {
        $this->assign('key', 'wx');
        $this->display();
    }

    public function learn_wxdetail() {
        $this->assign('key', 'wx');
        $this->display();
    }

    /**
     * 获取列表
     */
    public function getList() {
        $num = C('PAGE_NUM')['apptlearn'] * $_POST['page'];

        $apptlearnArr = M('ApptLearnInfo')->where('is_publish=1')->order('id desc')->limit($num)->select();
        $count = M('ApptLearnInfo')->where('is_publish=1')->count();

//        dump(M('ApptlearnInfo')->getLastSql());exit;
        if ($num < $count) {
            $returnData['ajaxLoad'] = '点击加载更多';
            $returnData['is_end'] = 0;
        } else {
            $returnData['ajaxLoad'] = '已加载全部';
            $returnData['is_end'] = 1;
        }
        if (empty($apptlearnArr)) {
            $returnData['flag'] = 0;
        } else {
            for ($i = 0; $i < count($apptlearnArr); $i++) {
                $data[$i]['id'] = $apptlearnArr[$i]['id'];
                $data[$i]['teacher'] = $apptlearnArr[$i]['teacher'];
                $data[$i]['title'] = str_replace($keyword, '<font color="red">' . $keyword . '</font>', $apptlearnArr[$i]['title']);
                $time = tranTimeToCom($apptlearnArr[$i]['start_time']);
                $data[$i]['start_time'] = $time['ymd'] . ' ' . $time['hi'];
                $data[$i]['content'] = $apptlearnArr[$i]['content'];
                $data[$i]['apptlearn_pic'] = $this->getApptLearnPicPath($apptlearnArr[$i]['id']);
                $data[$i]['is_read'] = strstr($apptlearnArr[$i]['read_ids'], ',' . $user_id . ',') == FALSE ? 0 : 1;
                $data[$i]['not_read_num'] = $notReadCount;
            }
            $returnData['page'] = $_POST['page'];

            $returnData['flag'] = 1;
            $returnData['data'] = $data;
        }
//        $returnData['sql'] = M('ApptlearnInfo')->getLastSql();
        $this->ajaxReturn($returnData);
    }

    public function getApptLearnPicPath($id) {
        $attchModel = M('sys_all_attach');
        $where['module_name'] = array('EQ', 'apptlearn');
        $where['module_info_id'] = array('EQ', $id);
        $picArr = $attchModel->where($where)->find();
        if (empty($picArr)) {
            return 'Public/Upload/common/no-pic.jpg';
        } else {
            return $picArr['file_path'];
        }
    }

    /**
     * 获取详情
     */
    public function getApptlearnDetail() {
        $user_id = cookie('user_id');
        $findArr = M('ApptLearnInfo')->where('id=' . $_GET['id'])->find();
        if (empty($findArr)) {
            $returnData['flag'] = 0;
            $returnData['msg'] = '操作失败,请重新操作';
        } else {
            $findArr['apptlearn_pic'] = $this->getApptlearnPicPath($findArr['id']);
            $time = tranTimeToCom($findArr['start_time']);
            $findArr['start_time'] = $time['ymd'] . ' ' . $time['hi'];
            $findArr['add_time'] = tranTime($findArr['add_time']);
            $updData['read_num'] = $findArr['read_num'] + 1;
            $updArr = M('ApptLearnInfo')->where('id=' . $_GET['id'])->save($updData);
            if ($updArr === FALSE) {
                $returnData['flag'] = 0;
                $returnData['msg'] = '操作失败,请重新操作';
            } else {
                $returnData['flag'] = 1;
                $returnData['msg'] = '操作成功';
//                数据处理
                $findArr['realname'] = $this->getRealnameById($findArr['user_id']);
                $returnData['data'] = $findArr;
            }
        }
        $this->ajaxReturn($returnData);
    }

    /**
     * 通过id获取真实姓名
     * @param type $id
     * @return int
     */
    public function getRealnameById($id) {
        $userModel = M(C('DB_USER_INFO'));
        $findArr = $userModel->where('id=' . $id)->find();
        if (empty($findArr)) {
            return 0;
        } else {
            if ($findArr['realname'] != '' && $findArr['realname'] != null) {
                return $findArr['realname'];
            } else {
                return $findArr['usr'];
            }
        }
    }

}
