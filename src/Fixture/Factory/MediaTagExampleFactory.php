<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Fixture\Factory;

use Abenmada\MediaPlugin\Entity\Media\MediaTag;
use Abenmada\MediaPlugin\Entity\Media\MediaTagTranslation;
use Sylius\Bundle\CoreBundle\Fixture\Factory\AbstractExampleFactory;
use Sylius\Bundle\CoreBundle\Fixture\Factory\ExampleFactoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaTagExampleFactory extends AbstractExampleFactory implements ExampleFactoryInterface
{
    private OptionsResolver $optionsResolver;

    public function __construct(
        private readonly FactoryInterface $mediaTagFactory,
        private readonly FactoryInterface $mediaTagTranslationFactory
    ) {
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): MediaTag
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var MediaTag $mediaTag */
        $mediaTag = $this->mediaTagFactory->createNew();

        $mediaTag->setCode($options['code']);

        foreach ($options['translations'] as $localeCode => $translation) {
            /** @var MediaTagTranslation $mediaTagTranslation */
            $mediaTagTranslation = $this->mediaTagTranslationFactory->createNew();

            $mediaTagTranslation->setLocale($localeCode);
            $mediaTagTranslation->setLabel($translation['label']);
            $mediaTag->addTranslation($mediaTagTranslation);
        }

        return $mediaTag;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefined('code')
            ->setDefined('translations');
    }
}
