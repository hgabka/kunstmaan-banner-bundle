<?php
/**
 * Created by PhpStorm.
 * User: sfhun
 * Date: 2017.09.16.
 * Time: 12:29
 */

namespace Hgabka\KunstmaanBannerBundle\AdminList;

use Doctrine\ORM\EntityManager;
use Hgabka\KunstmaanBannerBundle\Form\BannerAdminType;
use Hgabka\KunstmaanBannerBundle\Helper\BannerHandler;
use Kunstmaan\AdminBundle\Helper\Security\Acl\AclHelper;
use Kunstmaan\AdminListBundle\AdminList\Configurator\AbstractDoctrineORMAdminListConfigurator;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class BannerAdminListConfigurator extends AbstractDoctrineORMAdminListConfigurator
{
    /** @var BannerHandler */
    private $handler;

    /** @var  RouterInterface */
    protected $router;

    /**
     * @param EntityManager $em The entity manager
     * @param AclHelper $aclHelper The acl helper
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
        $this->addField('place', 'hgabka_kuma_banner.labels.place', false);
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
}