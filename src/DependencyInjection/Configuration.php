<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Hgabka\KunstmaanBannerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Configuration implements ConfigurationInterface
{
    /** @var ContainerBuilder */
    private $container;

    public function __construct(ContainerBuilder $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('hgabka_kunstmaan_banner');
        $rootNode
            ->children()
                ->arrayNode('places')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('label')->end()
                            ->scalarNode('width')->defaultNull()->end()
                            ->scalarNode('height')->defaultNull()->end()
                            ->scalarNode('template')->defaultValue('HgabkaKunstmaanBannerBundle:Banner:show.html.twig')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end()
        ;

        return $treeBuilder;
    }
}
