<?php
/**
 * Created by PhpStorm.
 * Author: Seth
 * E-mail: mail@imseth.cn
 * Date: 17-4-27
 * Time: 下午8:21
 */

function callback_init(){
    $data = [
        'id' => '2d4a628f5fb5374fda3b7ba8548752e4',
        'key' => 'dadf806086e5152dd1f4038ac4b962bc',
        'login'=> 0,
        'register' => 0
    ];
    option::pset('seth_geetest', $data);

}