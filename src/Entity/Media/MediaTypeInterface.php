<?php

declare(strict_types=1);

namespace Abenmada\MediaPlugin\Entity\Media;

interface MediaTypeInterface
{
    public const string IMAGE = 'image';

    public const string AUDIO = 'audio';

    public const string VIDEO = 'video';

    public const string DOCUMENT = 'document';

    public const array ALL = [
        'abenmada_media_plugin.media.types.' . self::IMAGE => self::IMAGE,
        'abenmada_media_plugin.media.types.' . self::AUDIO => self::AUDIO,
        'abenmada_media_plugin.media.types.' . self::VIDEO => self::VIDEO,
        'abenmada_media_plugin.media.types.' . self::DOCUMENT => self::DOCUMENT,
    ];
}
