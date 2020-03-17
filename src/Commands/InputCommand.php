<?php


namespace MyShell\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class InputCommand extends Command
{
    use CommandTrait;

    protected static $defaultName = 'input';

    protected function configure()
    {
        $this
            ->setDescription('输入示例')
            ->addArgument('required', InputArgument::REQUIRED, '必要参数')
            ->addArgument('optional', InputArgument::OPTIONAL, '可选参数')
            ->addArgument('array', InputArgument::IS_ARRAY, '数组参数')
            ->addOption('option_none', 'e', InputOption::VALUE_NONE, '不接收参数选项')
            ->addOption('option_required', 'r', InputOption::VALUE_REQUIRED, '必填选项')
            ->addOption('option_optional', 'o', InputOption::VALUE_OPTIONAL, '可选选项')
            // 数组选项必须设定是可选的还是必选的，InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL 中间用 |
            ->addOption('option_array', 'a', InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL, '多选选项', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $required = $input->getArgument('required'); // 必选参数
        $optional = $input->getArgument('optional'); // 可选参数
        $array = $input->getArgument('array'); // 数组参数
        $option_none = $input->getOption('option_none'); // 无值选项
        $option_required = $input->getOption('option_required'); // 必选选项，虽然说是必选选项，但是只要命令中不带该选项也不会报错，一旦带了该选项，就必选设定该选项值
        $option_optional = $input->getOption('option_optional'); // 可选选项
        $option_array = $input->getOption('option_array'); // 数组选项

        $output->writeln('必填值为：' . '<comment>' . $required . '</comment>');
        $output->writeln('选填值为：' . '<comment>' . $optional . '</comment>');
        $output->writeln('数组值为：' . '<comment>' . implode(',', $array) . '</comment>');
        $output->writeln('无值选项为：' . '<comment>' . $option_none . '</comment>;类型为：<comment>' . gettype($option_none) . '</comment>');
        $output->writeln('必填选项为：' . '<comment>' . $option_required . '</comment>');
        $output->writeln('选填选项为：' . '<comment>' . $option_optional . '</comment>');
        $output->writeln('多选选项为：' . '<comment>' . implode(',', $option_array) . '</comment>');

        return 0;
    }
}