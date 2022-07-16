<?php
declare (strict_types = 1);

namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

class GenCaptchaCommand extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('gen:captcha')
            ->setDescription('the app\command\gencaptchacommand command');
    }

    protected function execute(Input $input, Output $output)
    {
        for ($i=0; $i < 50000; $i++) { 
            $this->captcha();
        }

        // 文件名格式：code_hash.png
        // 指令输出
        $output->writeln('app\command\gencaptchacommand');
    }
    
    protected function captcha()
    {
        // 生成验证码图片
        $img = captcha()->getContent(true);
        $code = session('captcha.code');
        $dir = sprintf('%s%s', runtime_path(), 'captcha');

        if(!file_exists($dir)){
            mkdir($dir);
        }

        $filename = sprintf('%s/%s_%s.png', $dir, $code, time());
        
        try {
            \file_put_contents($filename, $img);
        } catch (\Throwable $e) {
            throw new \Exception(\sprintf('Cannot save img to %s', $filename), $e->getCode(), $e);
        }

        dump([$filename => \file_exists($filename)]);
    }
}
