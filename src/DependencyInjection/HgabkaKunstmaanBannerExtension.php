<?php

namespace Hgabka\KunstmaanBannerBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class HgabkaKunstmaanBannerExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration($container);
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $handlerDefinition = $container->getDefinition('hgabka_kunstmaan_banner.banner_handler');
        $handlerDefinition->replaceArgument(2, $config['places']);

        $voterDefinition = $container->getDefinition('hgabka_kunstmaan_banner.banner_voter');
        $voterDefinition->replaceArgument(1, $config['editor_role']);

        $menuAdaptorDefinition = $container->getDefinition('hgabka_kunstmaan_banner.menu.adaptor.banner');
        $menuAdaptorDefinition->replaceArgument(1, $config['editor_role']);

        $container->setParameter('hgabka_kunstmaan_banner.editor_role', $config['editor_role']);
    }
}
