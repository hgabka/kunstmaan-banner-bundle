<?php

namespace Hgabka\KunstmaanBannerBundle\AdminList;

use Doctrine\ORM\EntityManager;
use Hgabka\KunstmaanBannerBundle\Entity\Banner;
use Hgabka\KunstmaanBannerBundle\Form\BannerAdminType;
use Hgabka\KunstmaanBannerBundle\Helper\BannerHandler;
use Hgabka\KunstmaanBannerBundle\Security\BannerVoter;
use Kunstmaan\AdminBundle\Helper\Security\Acl\AclHelper;
use Kunstmaan\AdminListBundle\AdminList\Configurator\AbstractDoctrineORMAdminListConfigurator;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class BannerAdminListConfigurator extends AbstractDoctrineORMAdminListConfigurator
{
    /** @var RouterInterface */
    protected $router;
    /** @var AuthorizationChecker */
    private $authChecker;

    /** @var BannerHandler */
    private $handler;

    /** @var string */
    private $editorRole;

    /**
     * @param EntityManager $em        The entity manager
     * @param AclHelper     $aclHelper The acl helper
     */
    public function __construct(EntityManager $em, AuthorizationChecker $authChecker, BannerHandler $handler, RouterInterface $router, string $editorRole, AclHelper $aclHelper = null)
    {
        parent::__construct($em, $aclHelper);
        $this->handler = $handler;
        $this->authChecker = $authChecker;
        $this->editorRole = $editorRole;

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

    public function canAdd()
    {
        return $this->authChecker->isGranted($this->editorRole);
    }

    public function canEdit($item)
    {
        return $this->authChecker->isGranted(BannerVoter::EDIT, $item);
    }

    public function canDelete($item)
    {
        return $this->authChecker->isGranted(BannerVoter::EDIT, $item);
    }

    public function getTabFields()
    {
        return [
            'hgabka_kuma_banner.tabs.general' => ['name', 'place', 'start', 'end', 'priority', 'locale'],
            'hgabka_kuma_banner.tabs.content' => ['type', 'media', 'hoverMedia', 'imageAlt', 'imageTitle', 'url', 'newWindow'],
        ];
    }
}
