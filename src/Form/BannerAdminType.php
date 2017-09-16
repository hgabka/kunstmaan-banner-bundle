<?php
/**
 * Created by PhpStorm.
 * User: sfhun
 * Date: 2017.09.16.
 * Time: 12:36
 */

namespace Hgabka\KunstmaanBannerBundle\Form;

use Hgabka\KunstmaanBannerBundle\Helper\BannerHandler;
use Hgabka\KunstmaanExtensionBundle\Form\Type\DatepickerType;
use Kunstmaan\AdminBundle\Form\WysiwygType;
use Kunstmaan\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Routing\RouterInterface;

class BannerAdminType extends AbstractType
{
    /** @var  BannerHandler */
    protected $handler;

    /** @var  RouterInterface */
    protected $router;

    /**
     * BannerAdminType constructor.
     * @param BannerHandler $handler
     */
    public function __construct(BannerHandler $handler, RouterInterface $router)
    {
        $this->handler = $handler;
        $this->router = $router;
    }

    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting form the
     * top most type. Type extensions can further modify the form.
     *
     * @see FormTypeExtensionInterface::buildForm()
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'hgabka_kuma_banner.labels.name', 'required' => true])
            ->add('place', ChoiceType::class, [
                'label' => 'hgabka_kuma_banner.labels.place',
                'choices' => array_flip($this->handler->getPlaceChoices()),
                'attr' => ['data-url' => $this->router->generate('hgabkakunstmaanbannerbundle_admin_banner_get_place_data')]
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'hgabka_kuma_banner.labels.type',
                'expanded' => true,
                'choices' => array_flip($this->handler->getTypeChoices()),
                'required' => true,
                ]
            )
            ->add('media', MediaType::class, [
                'label' => 'hgabka_kuma_banner.labels.media',
                'required' => false,
                'attr' => ['info_text' => '']
            ])
            ->add('hoverMedia', MediaType::class, [
                'label' => 'hgabka_kuma_banner.labels.hover_media',
                'required' => false,
            ])
            ->add('imageAlt', TextType::class, [
                'label' => 'hgabka_kuma_banner.labels.image_alt',
                'required' => false,
            ])
            ->add('imageTitle', TextType::class, [
                'label' => 'hgabka_kuma_banner.labels.image_title',
                'required' => false,
            ])
            ->add('html', WysiwygType::class, [
                'label' => 'hgabka_kuma_banner.labels.html',
                'required' => false,
            ])
            ->add('start', DatepickerType::class, [
                'required' => false,
                'label' => 'hgabka_kuma_banner.labels.start',
                'locale' => 'hu'
            ])
            ->add('end', DatepickerType::class, [
                'required' => false,
                'label' => 'hgabka_kuma_banner.labels.end',
                'locale' => 'hu'
            ])
        ;
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getBlockPrefix()
    {
        return 'hgabka_kunstmaanbanner_banner_type';
    }
}
