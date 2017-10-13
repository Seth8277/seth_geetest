<?php
/**
 * Created by PhpStorm.
 * Author: Seth
 * E-mail: mail@imseth.cn
 * Date: 17-4-27
 * Time: 下午7:16
 */
?>
<!--该网站正在使用 seth_geetest 插件-->
<script type="text/javascript" src="/plugins/seth_geetest/gt.js"></script>
<script type="text/javascript">
    $(function () {
        $('.login-button button').attr('disabled', true);
        var handlerEmbed = function (captchaObj) {
            captchaObj.appendTo("#captcha");

            captchaObj.onSuccess(function () {
                $('.login-button button').attr('disabled', false);
            });
        };
        $.ajax({
            url: "/index.php?pub_plugin=seth_geetest&t=" + (new Date()).getTime(), // 加随机数防止缓存
            type: "get",
            dataType: "json",
            success: function (data) {
                initGeetest({
                    gt: data.gt,
                    challenge: data.challenge,
                    new_captcha: data.new_captcha,
                    offline: !data.success
                }, handlerEmbed);
            },
            error: function (event, XMLHttpRequest, ajaxOptions, thrownError) {
                console.log('验证码载入出错');
            }
        });
    });
</script>
<br />