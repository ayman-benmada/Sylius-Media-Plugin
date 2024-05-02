<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class MediaFileType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->remove('type')
            ->add('file', FileType::class, [
                'label' => false,
                'constraints' => [new NotBlank(['groups' => 'abenmada_media_plugin'])],
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'abenmada_media_plugin_media_file_type';
    }
}
