<?php


namespace MyShell\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

class TableCommand extends Command
{
    use CommandTrait;

    protected function configure()
    {
        $this->setName('table')
            ->setDescription('演示表格输出')
            ->addOption('return', 'r', InputOption::VALUE_NONE, '是否返回主菜单');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $table
            ->setHeaders(['序号', '姓名', '性别'])
            ->setRows([
                ['1', '张三', '男'],
                ['2', '李四', '男'],
                new TableSeparator(), // 分隔符
                ['3', '翠花', '女'],
                ['4', '秀吉', '秀吉'],
            ]);
        $table->render();

        if (!$input->getOption('return')) {
            return 0;
        }

        return $this->returnView($input, $output);
    }
}