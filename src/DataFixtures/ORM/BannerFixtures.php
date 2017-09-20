<?php

namespace Hgabka\KunstmaanBannerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Kunstmaan\MediaBundle\Entity\Folder;
use Kunstmaan\MediaBundle\Helper\Services\MediaCreatorService;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class NewsFixtures
 *
 */
class BannerFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container = null;

    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->createMediaFolder();
    }

    /**
     * Create some dummy media files
     */
    private function createMediaFolder()
    {
        /** @var TranslatorInterface $translator */
        $translator = $this->container->get('translator');

        // Add images to database
        $folderRepo = $this->manager->getRepository('KunstmaanMediaBundle:Folder');
        $imageFolder = $folderRepo->findOneBy(['rel' => 'image']);

        $bannerFolder = $folderRepo->findOneByInternalName('banner');
        if (!$bannerFolder) {
            $bannerFolder = new Folder();
            $bannerFolder
                ->setParent($imageFolder)
                ->setInternalName('banner')
                ->setName($translator->trans('hgabka_kuma_banner.fixtures.folder_name', [], null, $this->container->getParameter('defaultlocale')))
                ->setRel('banner')
            ;
            $this->manager->persist($bannerFolder);
            $this->manager->flush();
        }
    }

    /**
     * Get the order of this fixture
     *
     * @return int
     */
    public function getOrder()
    {
        return 52;
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface $container A ContainerInterface instance
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
