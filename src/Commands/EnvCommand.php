<?php


namespace MyShell\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class EnvCommand extends Command
{
    use CommandTrait;

    protected function configure()
    {
        $this->setName('env')
            ->setDescription('获取env配置演示')
            ->addOption('return', 'r', InputOption::VALUE_NONE, '是否返回主菜单');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $_ENV['NAME'];
        $output->writeln('我的脚本名称是：' . "<comment>$name</comment>");

        if (!$input->getOption('return')) {
            return 0;
        }

        return $this->returnView($input, $output);
    }
}