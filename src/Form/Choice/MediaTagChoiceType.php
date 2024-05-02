<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Form\Choice;

use Abenmada\MediaPlugin\Entity\Media\MediaTag;
use function is_bool;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaTagChoiceType extends AbstractType
{
    public function __construct(private readonly RepositoryInterface $mediaTagRepository)
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
            'choices' => fn (Options $options): array => $this->mediaTagRepository->findAll(),
            'choice_value' => 'id',
            'choice_label' => static fn (MediaTag $mediaTag): ?string => $mediaTag->getLabel(),
            'choice_translation_domain' => false,
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'abenmada_media_plugin_media_tag_choice_type';
    }
}
