<?php


namespace MyShell\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OutPutCommand extends Command
{
    use CommandTrait;

    protected static $defaultName = 'output';

    protected function configure()
    {
        $this
//            ->setName('output')
            ->setDescription('输出示例')
            ->addOption('return', 'r', InputOption::VALUE_NONE, '是否返回主菜单')
            ->addArgument('type', InputArgument::OPTIONAL, '演示类型', 1)
            ->setHelp('各种输出示例，文字、颜色');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getArgument('type');

        // 演示换行
        if ($type == 1) {
            // 不换行
            $output->write('我是');
            $output->write('不换行的输出');
            $output->write("\n");

            $output->writeln('-----------------');

            // 换行
            $output->writeln('我是');
            $output->writeln('换行的输出');
        }

        // 演示颜色
        if ($type == 2) {
            //绿字
            $output->writeln('<info>绿字</info>');
            // 黄字
            $output->writeln('<comment>黄字</comment>');
            // 青色背景上的黑字
            $output->writeln('<question>青色背景</question>');
            // 红背景上的白字
            $output->writeln('<error>红背景</error>');
            // 黄字紫背景
            $output->writeln('<fg=yellow;bg=magenta>黄字紫背景</>');
        }

        // 演示区块操作
        if ($type == 3) {
            $output->writeln('区块演示：');
            // 区块
            $section1 = $output->section();
            $section2 = $output->section();
            $section1->writeln('Hello');
            $section2->writeln('World!');

            sleep(1);
            $section1->overwrite('Beautiful'); // 替换区块1内容
            sleep(1);
            $section1->clear(); // 清除区块1内容
            sleep(1);
            $section2->clear(2); // 清除最后2行，如果区块有内容，会和区块上方输出一起删除
        }

        if (!$input->getOption('return')) {
            return 0;
        }

        return $this->returnView($input, $output);
    }
}