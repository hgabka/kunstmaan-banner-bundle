<?php

namespace Hgabka\KunstmaanBannerBundle\Helper;

use Hgabka\KunstmaanExtensionBundle\Helper\KumaUtils;

class BannerHandler
{
    const
        TYPE_IMAGE = 'image',
        TYPE_HTML = 'html';

    /** @var  KumaUtils */
    protected $kumaUtils;

    /** @var  array */
    protected $placeConfig;

    /**
     * BannerHandler constructor.
     * @param KumaUtils $kumaUtils
     * @param array $placeConfig
     */
    public function __construct(KumaUtils $kumaUtils, array $placeConfig)
    {
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
        $choices = ['' => ''];
        foreach ($this->placeConfig as $name => $data) {
            $choices[$name] = $data['label'];
        }

        return $choices;
    }

    /**
     * @return array
     */
    public function getTypeChoices()
    {
        return $this
            ->kumaUtils
            ->prefixArrayElements([self::TYPE_IMAGE, self::TYPE_HTML], 'hgabka_kuma_banner.types.')
        ;
    }

    /**
     * @return KumaUtils
     */
    public function getKumaUtils(): KumaUtils
    {
        return $this->kumaUtils;
    }
}
