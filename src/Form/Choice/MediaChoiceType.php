<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Form\Choice;

use Abenmada\MediaPlugin\Entity\Media\Media;
use Abenmada\MediaPlugin\Repository\MediaRepository;
use function is_bool;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaChoiceType extends AbstractType
{
    public function __construct(private readonly MediaRepository $mediaRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if (is_bool($options['multiple']) && !$options['multiple']) {
            return;
        }

        $builder->addModelTransformer(new CollectionToArrayTransformer());
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => function (Options $options): array {
                $channelCodes = $options['row_attr']['channels'] ?? null;
                $tagCodes = $options['row_attr']['tags'] ?? null;
                $types = $options['row_attr']['types'] ?? null;

                return $this->mediaRepository->findAllByChannelCodesAndTagCodesAndTypes($channelCodes, $tagCodes, $types);
            },
            'choice_value' => 'id',
            'choice_label' => static fn (Media $media): string => $media->getCode(),
            'choice_translation_domain' => false,
            'choice_attr' => static fn (Media $media): array => [
                'data-path' => $media->getFile()->getPath(),
                'data-type' => $media->getType(),
            ],
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'abenmada_media_plugin_media_choice_type';
    }
}
