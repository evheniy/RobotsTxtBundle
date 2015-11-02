<?php
namespace Evheniy\RobotsTxtBundle\DependencyInjection;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
/**
 * Class Configuration
 * @package Evheniy\RobotsTxtBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('robots_txt');
        $rootNode
            ->children()
            ->end();
        return $treeBuilder;
    }
}