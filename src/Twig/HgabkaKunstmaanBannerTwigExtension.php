<?php

namespace Hgabka\KunstmaanBannerBundle\Twig;

use Hgabka\KunstmaanBannerBundle\Helper\BannerHandler;

class HgabkaKunstmaanBannerTwigExtension extends \Twig_Extension
{
    /**
     * @var BannerHandler
     */
    protected $handler;

    /**
     * PublicTwigExtension constructor.
     *
     * @param BannerHandler $handler
     */
    public function __construct(BannerHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('show_banner', [$this, 'showBanner'], [
                'needs_environment' => true,
                'is_safe' => ['html'],
                ]),
            new \Twig_SimpleFunction('has_banner', [$this, 'hasBanner'], [
                ]),
        ];
    }

    /**
     * @param \Twig_Environment $environment
     * @param string            $place
     *
     * @return string
     */
    public function showBanner(\Twig_Environment $environment, string $place)
    {
        $banner = $this->handler->getBannerForPlace($place);

        if (!$banner) {
            return '';
        }

        $template = $this->handler->getPlaceTemplate($place);

        return $template ? $environment->render($template, ['place' => $place, 'banner' => $banner]) : '';
    }

    public function hasBanner(string $place)
    {
        return $this->handler->placeHasBanner($place);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'hgabka_kunstmaan_banner.banner_twig_extension';
    }
}
