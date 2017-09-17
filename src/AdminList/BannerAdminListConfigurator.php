<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Hgabka\KunstmaanBannerBundle\AdminList;

use Doctrine\ORM\EntityManager;
use Hgabka\KunstmaanBannerBundle\Form\BannerAdminType;
use Hgabka\KunstmaanBannerBundle\Helper\BannerHandler;
use Kunstmaan\AdminBundle\Helper\Security\Acl\AclHelper;
use Kunstmaan\AdminListBundle\AdminList\Configurator\AbstractDoctrineORMAdminListConfigurator;
use Symfony\Component\Routing\RouterInterface;

class BannerAdminListConfigurator extends AbstractDoctrineORMAdminListConfigurator
{
    /** @var RouterInterface */
    protected $router;
    /** @var BannerHandler */
    private $handler;

    /**
     * @param EntityManager $em        The entity manager
     * @param AclHelper     $aclHelper The acl helper
     */
    public function __construct(EntityManager $em, BannerHandler $handler, RouterInterface $router, AclHelper $aclHelper = null)
    {
        parent::__construct($em, $aclHelper);
        $this->handler = $handler;

        $this->setAdminType(new BannerAdminType($handler, $router));
    }

    /**
     * Configure the visible columns.
     */
    public function buildFields()
    {
        $this->addField('name', 'hgabka_kuma_banner.labels.name', true);
        $this->addField('place', 'hgabka_kuma_banner.labels.place', false, 'HgabkaKunstmaanBannerBundle:AdminList:Banner\place.html.twig');
        $this->addField('start', 'hgabka_kuma_banner.labels.start', false);
        $this->addField('end', 'hgabka_kuma_banner.labels.end', false);
    }

    /**
     * Build filters for admin list.
     */
    public function buildFilters()
    {
    }

    /**
     * Get bundle name.
     *
     * @return string
     */
    public function getBundleName()
    {
        return 'HgabkaKunstmaanBannerBundle';
    }

    /**
     * Get entity name.
     *
     * @return string
     */
    public function getEntityName()
    {
        return 'Banner';
    }

    public function getListTitle()
    {
        return 'Bannerek';
    }

    /**
     * Returns edit title.
     *
     * @return null|string
     */
    public function getEditTitle()
    {
        return 'Banner szerkesztése';
    }

    /**
     * Returns new title.
     *
     * @return null|string
     */
    public function getNewTitle()
    {
        return 'Új banner';
    }

    public function getAddTemplate()
    {
        return 'HgabkaKunstmaanBannerBundle:AdminList:Banner\add_or_edit.html.twig';
    }

    public function getEditTemplate()
    {
        return 'HgabkaKunstmaanBannerBundle:AdminList:Banner\add_or_edit.html.twig';
    }

    /**
     * @return BannerHandler
     */
    public function getHandler(): BannerHandler
    {
        return $this->handler;
    }
}
