<?php


namespace MyShell\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class QuestionCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('question')
            ->setDescription('询问演示');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // 提问助手
        $helper = $this->getHelper('question');

        // 普通问题
        $output->writeln('<info>普通询问</info>');
        $question = new Question('<comment>请输入你的名字：</comment>');
        $name = $helper->ask($input, $output, $question);
        $question = new Question('<comment>请输入你的年龄：</comment>');
        $age = $helper->ask($input, $output, $question);

        // 确认问题
        $output->writeln('<info>确认询问</info>');
        $question = new ConfirmationQuestion('<comment>是否要设定性别？</comment>', true);
        // 第三参数可以设定匹配输入的选项值
//        $question = new ConfirmationQuestion('<comment>是否继续执行？</comment>', true, '/^(y|o)/i');

        $sex = '保密';
        if ($helper->ask($input, $output, $question)) {
            $output->writeln('你选择了继续');
            // 选项询问
            $output->writeln('<info>选项询问</info>');
            $question = new ChoiceQuestion('<comment>请选择性别：</comment>', ['男', '女']);
            $question->setErrorMessage('没有 %s 选项，请重新选择');
            $question->setMaxAttempts(2); // 设置最多尝试次数，超出次数会直接退出
            $sex = $helper->ask($input, $output, $question);
        } else {
            $output->writeln('你选择了取消');
        }

        // 自动填充
        $question = new Question('<comment>你的星座是：</comment>');
        $question->setAutocompleterValues(['白羊座', '金牛座', '双子座', '巨蟹座', '狮子座', '处女座', '天秤座', '天蝎座', '射手座', '摩羯座', '水瓶座', '双鱼座']);
        $constellation = $helper->ask($input, $output, $question);

        // 隐藏选项
        $question = new Question('<comment>你的密码是：</comment>');
        $question->setHidden(true);
        $question->setHiddenFallback(false);
        $password = $helper->ask($input, $output, $question);


        $output->writeln('你的名字是：<comment>' . $name . '</comment>');
        $output->writeln('你的年龄是：<comment>' . $age . '</comment>');
        $output->writeln('你的性别是：<comment>' . $sex . '</comment>');
        $output->writeln('你的星座是：<comment>' . $constellation . '</comment>');
        $output->writeln('你的密码：<comment>' . $password . '</comment>');

        return 0;
    }
}