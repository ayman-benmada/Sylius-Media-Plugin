<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MediaTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'abenmada_media_plugin.media.description',
            ])
            ->add('alt', TextType::class, [
                'required' => false,
                'label' => 'abenmada_media_plugin.media.alt',
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'abenmada_media_plugin_media_translation_type';
    }
}
