<?php
/**
 * Created by PhpStorm.
 * Author: Seth
 * E-mail: mail@imseth.cn
 * Date: 17-4-23
 * Time: 下午9:55
 */

if (!defined('SYSTEM_ROOT')) {
    die('Insufficient Permissions');
}


function login_show()
{
    if (option::xget('seth_geetest', 'login') != 0) {
        show();
    }

}

function register_show()
{
    if (option::xget('seth_geetest', 'register') != 0) {
        show();
    }

}

function login_check()
{
    if (option::xget('seth_geetest', 'login') != 0) {
        print_r($_POST);
        print_r('233333');
        if (!check()) {
            redirect('index.php?mod=login&error_msg=' . urlencode('请完成验证！'));
            die;
        }
    }
}

function register_check()
{
    if (option::xget('seth_geetest', 'register') != 0) {
        if (!check()) {
            msg('请完成验证！');
        }
    }
}

function check()
{
    session_start();
    require_once SYSTEM_ROOT . '/plugins/seth_geetest/lib/class.geetestlib.php';
    $gt = new GeetestLib(option::xget('seth_geetest', 'id'), option::xget('seth_geetest', 'key'));
    $data = [];
    if ($_SESSION['gtserver'] == 1) {   //服务器正常
        $result = $gt->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    } else {  //服务器宕机,走failback模式
        if ($gt->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode']) == 1) {
            return true;
        } else {
            return false;
        }
    }
}

function show()
{
    echo '<div id="captcha"></div>';
    include SYSTEM_ROOT . '/plugins/seth_geetest/js.php';
}

addAction('login_page_2', 'login_show');
addAction('reg_page_2', 'register_show');
addAction('admin_login_1', 'login_check');
addAction('admin_reg_1', 'register_check');