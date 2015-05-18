<?php

/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014-2015 Elcodi.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 * @author Elcodi Team <tech@elcodi.com>
 */

namespace Elcodi\Component\Plugin\Services;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

use Elcodi\Component\Plugin\PluginTypes;

/**
 * Class PluginConfiguration
 */
class PluginConfiguration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('plugin');
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->enumNode('type')
                    ->values([
                        PluginTypes::TYPE_PLUGIN,
                        PluginTypes::TYPE_TEMPLATE,
                    ])
                ->end()
                ->scalarNode('category')
                    ->defaultNull()
                ->end()
                ->scalarNode('name')
                    ->isRequired()
                ->end()
                ->scalarNode('visible')
                    ->defaultTrue()
                ->end()
                ->scalarNode('fa_icon')
                    ->defaultNull()
                ->end()
                ->scalarNode('description')
                    ->defaultNull()
                ->end()
                ->arrayNode('fields')
                    ->prototype('array')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->enumNode('type')
                               ->values([
                                   'integer',
                                   'text',
                                   'textarea',
                                   'boolean',
                                   'checkbox',
                                   'radio',
                                   'email',
                                   'password',
                                   'url',
                                   'date',
                                   'datetime',
                                   'time',
                                   'hidden',
                               ])
                            ->end()
                            ->booleanNode('required')
                                ->defaultFalse()
                            ->end()
                            ->scalarNode('data')
                                ->defaultNull()
                            ->end()
                            ->scalarNode('label')
                                ->defaultNull()
                            ->end()
                            ->arrayNode('options')
                                ->prototype('scalar')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
