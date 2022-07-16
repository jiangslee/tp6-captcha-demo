<?php
// +----------------------------------------------------------------------
// | 控制台配置
// +----------------------------------------------------------------------

use app\command\GenCaptchaCommand;

return [
    // 指令定义
    'commands' => [
        'gen:captcha' => GenCaptchaCommand::class,
    ],
];
