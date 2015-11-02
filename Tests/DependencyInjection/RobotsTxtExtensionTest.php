<?php

namespace Evheniy\RobotsTxtBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Evheniy\RobotsTxtBundle\DependencyInjection\RobotsTxtExtension;

/**
 * Class RobotsTxtExtensionTest
 * @package Evheniy\RobotsTxtBundle\Tests\DependencyInjection
 */
class RobotsTxtExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RobotsTxtExtension
     */
    private $extension;
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     *
     */
    protected function setUp()
    {
        $this->extension = new RobotsTxtExtension();
        $this->container = new ContainerBuilder();
        $this->container->registerExtension($this->extension);
    }

    /**
     * @param ContainerBuilder $container
     * @param string           $resource
     */
    protected function loadConfiguration(ContainerBuilder $container, $resource)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/Fixtures/'));
        $loader->load($resource . '.yml');
    }

    /**
     * Test normal config
     */
    public function testTest()
    {
        $this->loadConfiguration($this->container, 'test');
        $this->container->compile();
        $this->assertTrue($this->container->hasParameter('robots_txt'));
        $robotsTxt = $this->container->getParameter('robots_txt');
        $this->assertNotEmpty($robotsTxt);
        $this->assertEquals($robotsTxt[0], 'User-agent: *');
    }
}