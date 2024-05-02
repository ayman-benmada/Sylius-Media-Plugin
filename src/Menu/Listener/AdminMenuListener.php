<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Menu\Listener;

use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function invoke(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $this->addMediaChild($menu);
    }

    private function addMediaChild(ItemInterface $menu): void
    {
        $subMenu = $menu
            ->addChild('media')
            ->setLabel('abenmada_media_plugin.ui.media_library');

        $this->addMediaSubItem($subMenu);
        $this->addMediaTagSubItem($subMenu);
    }

    private function addMediaSubItem(ItemInterface $subMenu): void
    {
        $subMenu
            ->addChild('abenmada_media_plugin_media', ['route' => 'abenmada_media_plugin_admin_media_index'])
            ->setLabel('abenmada_media_plugin.ui.medias')
            ->setLabelAttribute('icon', 'images');
    }

    private function addMediaTagSubItem(ItemInterface $subMenu): void
    {
        $subMenu
            ->addChild('abenmada_media_plugin_media_tag', ['route' => 'abenmada_media_plugin_admin_media_tag_index'])
            ->setLabel('abenmada_media_plugin.ui.media_tags')
            ->setLabelAttribute('icon', 'tags');
    }
}
