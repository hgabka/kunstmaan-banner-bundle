<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Hgabka\KunstmaanBannerBundle\Helper\Menu;

use Kunstmaan\AdminBundle\Helper\Menu\MenuAdaptorInterface;
use Kunstmaan\AdminBundle\Helper\Menu\MenuBuilder;
use Kunstmaan\AdminBundle\Helper\Menu\MenuItem;
use Kunstmaan\AdminBundle\Helper\Menu\TopMenuItem;
use Symfony\Component\HttpFoundation\Request;

class BannerMenuAdaptor implements MenuAdaptorInterface
{
    /**
     * In this method you can add children for a specific parent, but also remove and change the already created children.
     *
     * @param MenuBuilder   $menu      The MenuBuilder
     * @param MenuItem[]    &$children The current children
     * @param null|MenuItem $parent    The parent Menu item
     * @param Request       $request   The Request
     */
    public function adaptChildren(MenuBuilder $menu, array &$children, MenuItem $parent = null, Request $request = null)
    {
        if (null === $parent) {
            $menuItem = new TopMenuItem($menu);
            $menuItem->setRoute('hgabkakunstmaanbannerbundle_admin_banner');
            $menuItem->setUniqueId('banner');
            $menuItem->setLabel('Bannerek');
            $menuItem->setParent($parent);

            $newChildren = [];
            $inserted = false;
            foreach ($children as $child) {
                if ('settings' === $child->getUniqueId()) {
                    $newChildren[] = $menuItem;
                    $inserted = true;
                }
                $newChildren[] = $child;
            }
            if (!$inserted) {
                $newChildren[] = $menuItem;
            }

            $children = $newChildren;

            if (0 === stripos($request->attributes->get('_route'), $menuItem->getRoute())) {
                $menuItem->setActive(true);
            }
        }
    }
}
