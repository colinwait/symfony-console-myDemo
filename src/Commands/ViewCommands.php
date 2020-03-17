<?php


namespace MyShell\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class ViewCommands extends Command
{
    use CommandTrait;

    /**
     * 配置命令
     */
    protected function configure()
    {
        $this
            ->setName('view') // 名称
            ->setDescription('一个命令行界面') // 描述
            ->setHelp("查看界面")
            ->addArgument('title', InputArgument::OPTIONAL, '接收参数') // OPTIONAL 可选参数，REQUIRED 必选，IS_ARRAY 可传入多个参数，需放置在最后一个
            ->addOption('show', 's', InputOption::VALUE_NONE, '选项'); // VALUE_NONE 作为选项值
    }

    /**
     * 执行，必须返回 int，通常 0-代表成功，1-代表失败
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($title = $input->getArgument('title')) {
            $output->writeln('title内容是：' . $title);
        }

        if (!$show = $input->getOption('show')) {
            return 0;
        }

        $section = $output->section();
        $section->writeln([
            '<fg=black;bg=cyan>这是一个我的Shell演示工具</>',
            '<info>===================</info>',
            '<info>1、HelloWorld</info>',
            '<info>2、有颜色的输出</info>',
            '<info>3、进度条</info>',
            '<info>4、表格</info>',
            '<info>5、env配置</info>',
            '<info>6、带返回菜单</info>',
            '<info>0、取消</info>',
        ]);

        // 提问助手
        $helper = $this->getHelper('question');
        $question = new Question('请输入选项：', 0);
        $option = $helper->ask($input, $output, $question);

        $section->clear();

        switch ($option) {
            case 1:
                $output->writeln('<comment>HelloWorld</comment>');
                break;
            case 2:
                $this->runCommand($output, 'output', []);
                break;
            case 3:
                $this->runCommand($output, 'progress', []);
                break;
            case 4:
                $this->runCommand($output, 'table', []);
                break;
            case 5:
                $this->runCommand($output, 'env', []);
                break;
            case 6:
                $this->runCommand($output, 'env', ['-r' => true]);
                break;
            default:
                return 0;
        }

        return 0;
    }
}