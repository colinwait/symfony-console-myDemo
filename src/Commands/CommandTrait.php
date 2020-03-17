<?php


namespace MyShell\Commands;


use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

trait CommandTrait
{
    /**
     * 执行其他命令
     *
     * @param OutputInterface $output
     * @param $command
     * @param array $args
     * @return mixed
     */
    public function runCommand(OutputInterface $output, $command, array $args = [])
    {
        $command = $this->getApplication()->find($command);

        $greetInput = new ArrayInput($args);

        return $command->run($greetInput, $output);
    }

    /**
     * 返回主页
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    public function returnView(InputInterface $input, OutputInterface $output)
    {
        $section = $output->section();

        $section->writeln([
            '<fg=black;bg=cyan>已完成展示，请选择：</>',
            '<info>===================</info>',
            '<info>1、返回</info>',
            '<info>0、取消</info>',
        ]);

        // 提问助手
        $helper = $this->getHelper('question');
        $question = new Question('请输入选项：', 0);
        $option = $helper->ask($input, $output, $question);

        $section->clear();

        if ($option) {
            $this->runCommand($output, 'view', ['-s' => true, 'title' => '我返回了']);
        }

        return 0;
    }
}