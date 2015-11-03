<?php

namespace Evheniy\RobotsTxtBundle\Tests\Command;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\StreamOutput;
use Evheniy\RobotsTxtBundle\Command\DumpCommand;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class DumpCommandTest
 *
 * @package Evheniy\RobotsTxtBundle\Tests\Command
 */
class DumpCommandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DumpCommand
     */
    protected $command;
    /**
     * @var \ReflectionClass
     */
    protected $reflectionClass;
    /**
     * @var Container
     */
    protected $container;
    /**
     * @var \ReflectionProperty
     */
    protected $webDirectory;
    /**
     * @var string
     */
    protected $webPath;
    /**
     * @var Filesystem
     */
    protected $filesystem;
    /**
     * @var \ReflectionProperty
     */
    protected $filesystemField;

    /**
     *
     */
    protected function setUp()
    {
        $this->command = new DumpCommand();
        $this->reflectionClass = new \ReflectionClass('\Evheniy\RobotsTxtBundle\Command\DumpCommand');
        $this->container = new Container();
        $this->webPath = dirname(__FILE__) . '/web';
        $this->filesystem = new Filesystem();
        $this->filesystem->mkdir($this->webPath);

        $this->setMockFields();
    }

    /**
     *
     */
    protected function setMockFields()
    {
        $this->webDirectory = $this->reflectionClass->getProperty('webDirectory');
        $this->webDirectory->setAccessible(true);
        $this->webDirectory->setValue($this->command, $this->webPath);
        $this->filesystemField = $this->reflectionClass->getProperty('filesystem');
        $this->filesystemField->setAccessible(true);
    }

    /**
     *
     */
    protected function tearDown()
    {
        $this->filesystem->remove($this->webPath);
    }

    /**
     *
     */
    public function testConfigure()
    {
        $this->assertEquals('robots.txt:dump', $this->command->getName());
        $this->assertEquals('Dumps robots.txt file', $this->command->getDescription());
    }

    /**
     *
     */
    public function testRender()
    {
        $this->command->setContainer($this->container);
        $method = $this->reflectionClass->getMethod('render');
        $method->setAccessible(true);
        $this->container->setParameter('robots_txt', array('User-agent: *'));
        $this->assertEquals($method->invoke($this->command), 'User-agent: *');
        $this->container->setParameter('robots_txt', array('User-agent: *', 'Sitemap: http://test.com/sitemap.xml'));
        $this->assertEquals($method->invoke($this->command), 'User-agent: *' . PHP_EOL . 'Sitemap: http://test.com/sitemap.xml');
    }

    /**
     *
     */
    public function testDump()
    {
        $this->filesystemField->setValue($this->command, new Filesystem());
        $this->command->setContainer($this->container);
        $method = $this->reflectionClass->getMethod('dump');
        $method->setAccessible(true);
        $this->container->setParameter('robots_txt', array('User-agent: *'));
        $method->invoke($this->command);
        $this->assertTrue($this->filesystem->exists(array($this->webPath . '/robots.txt')));
        $data = file_get_contents($this->webPath . '/robots.txt');
        $this->assertEquals('User-agent: *', $data);
    }

    /**
     *
     */
    public function testExecute()
    {
        $this->container->setParameter('robots_txt', array('User-agent: *', 'Sitemap: http://test.com/sitemap.xml'));
        $kernel = $this->getMock('Symfony\Component\HttpKernel\KernelInterface');
        $kernel->method('getRootdir')->willReturn($this->webPath);
        $this->container->set('kernel', $kernel);
        $this->command->setContainer($this->container);
        $method = $this->reflectionClass->getMethod('execute');
        $method->setAccessible(true);
        $output = new StreamOutput(fopen('php://memory', 'w', false));
        $method->invoke($this->command, new ArrayInput(array()), $output);
        rewind($output->getStream());
        $this->assertRegExp('/Done/', stream_get_contents($output->getStream()));
        $this->assertTrue($this->filesystem->exists(array($this->webPath . '/robots.txt')));
        $data = file_get_contents($this->webPath . '/robots.txt');
        $this->assertEquals('User-agent: *' . PHP_EOL . 'Sitemap: http://test.com/sitemap.xml', $data);
    }
}