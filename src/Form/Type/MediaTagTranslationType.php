<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class MediaTagTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', TextType::class, [
                'required' => true,
                'label' => 'abenmada_media_plugin.media_tag.label',
                'constraints' => [new NotBlank(['groups' => 'abenmada_media_plugin'])],
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'abenmada_media_plugin_media_tag_translation_type';
    }
}
