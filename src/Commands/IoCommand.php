<?php


namespace MyShell\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class IoCommand extends Command
{
    use CommandTrait;

    protected static $defaultName = 'io';

    protected function configure()
    {
        $this
            ->setDescription('IO演示')
            ->addArgument('type', InputArgument::OPTIONAL, '演示类型', 1)
            ->setHelp('io 便捷输出');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getArgument('type');
        $io = new SymfonyStyle($input, $output);

        if ($type == 1) {
            // 文字输出
            $io->text('我是个文本');
            $io->text(['我是文本一', '我是文本二']);
            $io->title('我是标题');
            $io->comment('文字说明');
            $io->success('成功');
            $io->error('错误');

            // 文本区块
            $io->section('这是个完整的内容
第二行
第三行');

            // 列表
            $io->listing([
                '文本一',
                '文本二',
            ]);

            // 横向表格
            $io->table(
                ['姓名', '性别'],
                [
                    ['小明', '男'],
                    ['小红', '女'],
                ]
            );

            // 纵向表格
            $io->horizontalTable(
                ['姓名', '性别'],
                [
                    ['小明', '男'],
                    ['小红', '女'],
                ]
            );

            // 自定义key/value的纵向表格
            $io->definitionList(
                '男生成绩',
                ['张三' => 90],
                ['李四' => 87],
                ['小明' => 100],
                new TableSeparator(),
                '女生成绩',
                ['小红' => 97]
            );

            // 换行
            $io->newLine(2);

            // 批注
            $io->note('批注');
            $io->note([
                '我是批注',
                '第二行',
                '第三行',
            ]);

            // 黄色警告
            $io->warning('警告');
            $io->warning([
                '我是警告',
                '第二行',
                '第三行',
            ]);

            // 红色警告
            $io->caution('警告');
            $io->caution([
                '我是警告',
                '第二行',
                '第三行',
            ]);
        }

        // 进度条
        if ($type == 2) {
            $io->progressStart(3);
            sleep(1);
            $io->progressAdvance();
            sleep(1);
            $io->progressAdvance();
            sleep(1);
            $io->progressAdvance();
            sleep(1);
            $io->progressFinish();
        }

        // 问题
        if ($type == 3) {
            $name = $io->ask('你是谁？'); // 普通问题
            $sex = $io->choice('性别：', ['男', '女']); // 选择
            $password = $io->askHidden('密码：'); // 隐藏
            $sure = $io->confirm('是否显示密码？'); // 确认
            $io->text([
                '姓名：' . $name,
                '性别：' . $sex,
                '密码：' . ($sure ? $password : ''),
            ]);
        }

        return 0;
    }
}