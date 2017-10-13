<?php
/**
 * Created by PhpStorm.
 * Author: Seth
 * E-mail: mail@imseth.cn
 * Date: 17-4-27
 * Time: 下午7:16
 */
if (!defined('SYSTEM_ROOT')) {
    die('Insufficient Permissions');
}
session_start();
require_once(SYSTEM_ROOT . '/plugins/seth_geetest/lib/class.geetestlib.php');
$data = [];
$gt = new GeetestLib(option::xget('seth_geetest', 'id'), option::xget('seth_geetest', 'key'));
$gt->pre_process($data, 1);
$status = $gt->pre_process($data, 1);
$_SESSION['gtserver'] = $status;
echo $gt->get_response_str();