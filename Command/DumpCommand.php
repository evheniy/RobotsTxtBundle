<?php
namespace Evheniy\RobotsTxtBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class DumpCommand
 *
 * @package Evheniy\RobotsTxtBundle\Command
 */
class DumpCommand extends ContainerAwareCommand
{
    /**
     * @var string
     */
    protected $webDirectory;
    /**
     * @var Filesystem
     */
    protected $filesystem;
    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('robots.txt:dump')
            ->setDescription('Dumps robots.txt file')
            ->setHelp("\nThe <info>%command.name%</info> command dumps robots.txt file.\n\n<info>%command.full_name%</info>\n");
    }
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $input;
        $output->writeln('<comment>Start dumping robots.txt...</comment>');
        $this->webDirectory = $this->getContainer()->get('kernel')->getRootdir() . '/../web';
        $this->filesystem = new Filesystem();
        $this->dump();
        $output->writeln('<info>Done</info>');
    }

    /**
     * @return string
     */
    protected function render()
    {
        return join(PHP_EOL, $this->getContainer()->getParameter('robots_txt'));
    }

    /**
     *
     */
    protected function dump()
    {
        $this->filesystem->dumpFile(
            $this->webDirectory . '/robots.txt',
            $this->render()
        );
    }
}