<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Fixture;

use Sylius\Bundle\CoreBundle\Fixture\AbstractResourceFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class MediaTagFixture extends AbstractResourceFixture
{
    public function getName(): string
    {
        return 'abenmada_media_plugin_media_tag';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
            ->scalarNode('code')->cannotBeEmpty()->end()
            ->arrayNode('translations')
            ->prototype('array')
            ->children()
            ->scalarNode('label')->cannotBeEmpty()->end()
            ->end()
            ->end()
            ->end();
    }
}
