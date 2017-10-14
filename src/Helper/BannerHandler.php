<?php

namespace Hgabka\KunstmaanBannerBundle\Helper;

use Doctrine\Common\Persistence\ManagerRegistry;
use Hgabka\KunstmaanBannerBundle\Entity\Banner;
use Hgabka\KunstmaanExtensionBundle\Helper\KumaUtils;

class BannerHandler
{
    const
        TYPE_IMAGE = 'image';
    const TYPE_HTML = 'html';

    /** @var KumaUtils */
    protected $kumaUtils;

    /** @var array */
    protected $placeConfig;

    /** @var ManagerRegistry */
    protected $doctrine;

    /**
     * BannerHandler constructor.
     *
     * @param ManagerRegistry $doctrine
     * @param KumaUtils       $kumaUtils
     * @param array           $placeConfig
     */
    public function __construct(ManagerRegistry $doctrine, KumaUtils $kumaUtils, array $placeConfig)
    {
        $this->doctrine = $doctrine;
        $this->kumaUtils = $kumaUtils;
        $this->placeConfig = $placeConfig;
    }

    /**
     * @return array
     */
    public function getPlaceConfig()
    {
        return $this->placeConfig;
    }

    /**
     * @return array
     */
    public function getPlaceChoices()
    {
        $choices = [];
        foreach ($this->placeConfig as $name => $data) {
            $choices[$name] = $data['label'];
        }

        return $choices;
    }

    /**
     * @param $place
     *
     * @return null|string
     */
    public function getPlaceLabel($place)
    {
        $choices = $this->getPlaceChoices();

        return $choices[$place] ?? null;
    }

    /**
     * @param $place
     *
     * @return null|string
     */
    public function getPlaceTemplate($place)
    {
        return $this->placeConfig[$place]['template'] ?? null;
    }

    /**
     * @return array
     */
    public function getTypeChoices()
    {
        return $this
            ->kumaUtils
            ->prefixArrayElements([self::TYPE_IMAGE, self::TYPE_HTML], 'hgabka_kuma_banner.types.');
    }

    /**
     * @return KumaUtils
     */
    public function getKumaUtils(): KumaUtils
    {
        return $this->kumaUtils;
    }

    public function getBannerForPlace($place)
    {
        if (empty($place) || !in_array($place, array_keys($this->getPlaceChoices()), true)) {
            return null;
        }

        $possibleBanners = $this
            ->doctrine
            ->getRepository('HgabkaKunstmaanBannerBundle:Banner')
            ->getBannersForPlace($place, $this->kumaUtils->getCurrentLocale())
        ;

        $displaySorsolo = [];
        foreach ($possibleBanners as $possibleBanner) {
            /** @var Banner $possibleBanner */
            $priority = $possibleBanner->getPriority();
            $priority = empty($priority) || $priority < 2 ? 2 : $priority;
            for ($i = 0; $i < $priority; ++$i) {
                $displaySorsolo[] = $possibleBanner;
            }
        }

        return empty($displaySorsolo) ? null : $displaySorsolo[array_rand($displaySorsolo)];
    }

    public function placeHasBanner($place)
    {
        if (empty($place) || !in_array($place, array_keys($this->getPlaceChoices()), true)) {
            return false;
        }

        $count = $this
            ->doctrine
            ->getRepository('HgabkaKunstmaanBannerBundle:Banner')
            ->countBannersForPlace($place, $this->kumaUtils->getCurrentLocale())
        ;

        return $count > 0;
    }
}
