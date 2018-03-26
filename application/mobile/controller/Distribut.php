<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2018/2/27
 * Time: 8:59
 */
namespace app\mobile\controller;
use app\common\logic\UsersLogic;
use app\common\logic\OrderLogic;
use think\Page;
use think\Request;
use think\db;

class Distribut extends MobileBase{

    public $user_id = 0;
    public $user = array();

    public function _initialize()
    {
        parent::_initialize();
        if (session('?user')) {
            $user = session('user');
            $user = M('users')->where("user_id", $user['user_id'])->find();
            session('user', $user);  //覆盖session 中的 user
            $this->user = $user;
            $this->user_id = $user['user_id'];
            $this->assign('user', $user); //存储用户信息
            $this->assign('user_id', $this->user_id);
        } else {
            header("location:" . U('User/login'));
            exit;
        }
    }

    public function index(){
        $host = "http://".$_SERVER['HTTP_HOST'];
        $this->assign('host', $host);
        return $this->fetch();
    }
}