<?php
namespace MyShell\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command {

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('第一步');
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('第二步');
    }

    protected function configure()
    {
        $this
            ->setName('test')
            ->setDescription('测试创建')
            ->addOption('option', 'o',InputOption::VALUE_OPTIONAL, '这是选项', '默认值');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('执行命令');

        return 0;
    }
}