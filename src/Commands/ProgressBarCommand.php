<?php


namespace MyShell\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class ProgressBarCommand extends Command
{
    use CommandTrait;

    protected function configure()
    {
        $this->setName('progress')
            ->setDescription('演示进度条输出')
            ->addArgument('type', InputArgument::OPTIONAL, '演示类型', 1)
            ->addOption('return', 'r', InputOption::VALUE_NONE, '是否返回主菜单');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getArgument('type');

        // 创建一个进度条 new ProgressBar($output, 步数)

        // 不指定步数，当 finish 的时候进度条结束
        if ($type == 1) {
            $output->writeln("<info>瞧一瞧看一看咧~</info>");
            $progress = new ProgressBar($output);

            for ($i = 0; $i < 10; $i++) {
                $progress->advance($i);
                sleep(1);
            }

            $progress->finish();

            $output->writeln("\n<info>完事儿~</info>");
        }

        // 指定步数有百分比，连续进度条
        if ($type == 2) {
            $output->writeln("<info>下载内容中...</info>");
            $progress = new ProgressBar($output, 3);

            $progress->advance(1);
            sleep(1);
            $progress->advance(1);
            sleep(1);
            $progress->advance(1);
            sleep(1);

            $progress->finish();
            $output->writeln("\n<info>下载完成</info>");

        }

        // 指定步数有百分比，穿插内容进度条
        if ($type == 3) {
            $output->writeln("<info>正在匹配对手...</info>");
            $progress = new ProgressBar($output, 3);

            $output->writeln("<info>正在整理卡牌</info>");
            $progress->advance(1);
            sleep(1);

            $progress->clear();
            $output->writeln("<info>正在活络胫骨</info>");
            $progress->display();
            $progress->advance(1);
            sleep(1);

            $progress->clear();
            $output->writeln("<info>正在寻找旗鼓相当的对手</info>");
            $progress->display();
            $progress->advance(1);
            sleep(1);

            $progress->finish();
            $output->writeln("\n<info>匹配完成</info>");
        }


        if (!$input->getOption('return')) {
            return 0;
        }

        return $this->returnView($input, $output);
    }
}