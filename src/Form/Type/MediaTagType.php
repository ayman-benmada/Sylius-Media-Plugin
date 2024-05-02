<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Valid;

class MediaTagType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, [
                'required' => true,
                'label' => 'abenmada_media_plugin.media_tag.code',
                'constraints' => [new NotBlank(['groups' => 'abenmada_media_plugin'])],
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => MediaTagTranslationType::class,
                'constraints' => [new Valid(['groups' => 'abenmada_media_plugin'])],
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'abenmada_media_plugin_media_tag_type';
    }
}
