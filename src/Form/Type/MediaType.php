<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Form\Type;

use Abenmada\MediaPlugin\Form\Choice\MediaTagChoiceType;
use Abenmada\MediaPlugin\Form\Choice\MediaTypeChoiceType;
use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Valid;

class MediaType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'required' => true,
                'label' => 'abenmada_media_plugin.media.code',
                'constraints' => [new NotBlank(['groups' => 'abenmada_media_plugin'])],
            ])
            ->add('file', MediaFileType::class, [
                'required' => true,
                'label' => 'abenmada_media_plugin.media.file',
                'constraints' => [new Valid(['groups' => 'abenmada_media_plugin'])],
            ])
            ->add('type', MediaTypeChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'label' => 'abenmada_media_plugin.media.type',
                'constraints' => [new NotBlank(['groups' => 'abenmada_media_plugin'])],
            ])
            ->add('tags', MediaTagChoiceType::class, [
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'label' => 'abenmada_media_plugin.media.tags',
            ])
            ->add('channels', ChannelChoiceType::class, [
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'label' => 'abenmada_media_plugin.media.channels',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => MediaTranslationType::class,
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'abenmada_media_plugin_media_type';
    }
}
