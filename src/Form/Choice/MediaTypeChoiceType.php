<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Form\Choice;

use Abenmada\MediaPlugin\Entity\Media\MediaTypeInterface;
use function is_bool;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class MediaTypeChoiceType extends AbstractType
{
    public function __construct(private readonly TranslatorInterface $translator)
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
            'choices' => MediaTypeInterface::ALL,
            'choice_label' => fn ($choice, $key, $value): string => $this->translator->trans($key),
            'choice_translation_domain' => false,
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'abenmada_media_plugin_media_type_choice_type';
    }
}
