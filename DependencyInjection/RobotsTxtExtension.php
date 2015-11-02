<?php

namespace Evheniy\RobotsTxtBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\Definition\Processor;

/**
 * Class RobotsTxtExtension
 *
 * @package Evheniy\RobotsTxtBundle\DependencyInjection
 */
class RobotsTxtExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);
        $container->setParameter('robots_txt', $config);
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'robots_txt';
    }
}