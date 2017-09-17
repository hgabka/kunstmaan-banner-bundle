<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

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

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'hgabka_kunstmaansettingsbundle_twig_extension';
    }
}
