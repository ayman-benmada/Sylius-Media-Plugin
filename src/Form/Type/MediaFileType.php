<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Form\Type;

use Abenmada\MediaPlugin\Entity\Media\MediaFile;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Contracts\Translation\TranslatorInterface;

class MediaFileType extends AbstractResourceType
{
    public function __construct(private readonly TranslatorInterface $translator, string $dataClass, array $validationGroups = [])
    {
        parent::__construct($dataClass, $validationGroups);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->remove('type')
            ->add('file', FileType::class, [
                'label' => false,
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();

                $mediaFile = $event->getData();
                assert($mediaFile instanceof MediaFile);

                if ($mediaFile->getFile() === null && $mediaFile->getPath() === null) {
                    $form->get('file')->addError(new FormError($this->translator->trans('This value should not be blank.', [], 'validators')));
                }
            });
    }

    public function getBlockPrefix(): string
    {
        return 'abenmada_media_plugin_media_file_type';
    }
}
