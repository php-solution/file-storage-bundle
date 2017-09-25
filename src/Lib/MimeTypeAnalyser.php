<?php

namespace PhpSolution\FileStorageBundle\Lib;

/**
 * MimeTypeAnalyser
 */
class MimeTypeAnalyser
{
    const TYPE_VIDEO = 'video';
    const TYPE_IMAGE = 'image';
    const TYPE_AUDIO = 'audio';
    const TYPE_TEXT = 'text';

    private $textMimeType = [
        'text/plain',
        'text/csv',
        'text/tab-separated-values',
        'text/calendar',
        'text/richtext',
        'text/css',
        'text/html',
        'application/rtf',
        'application/javascript',
        'application/pdf',
        'application/msword',
        'application/vnd.ms-powerpoint',
        'application/vnd.ms-write',
        'application/vnd.ms-excel',
        'application/vnd.ms-access',
        'application/vnd.ms-project',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-word.document.macroEnabled.12',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
        'application/vnd.ms-word.template.macroEnabled.12',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-excel.sheet.macroEnabled.12',
        'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
        'application/vnd.ms-excel.template.macroEnabled.12',
        'application/vnd.ms-excel.addin.macroEnabled.12',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
        'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
        'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
        'application/vnd.openxmlformats-officedocument.presentationml.template',
        'application/vnd.ms-powerpoint.template.macroEnabled.12',
        'application/vnd.ms-powerpoint.addin.macroEnabled.12',
        'application/vnd.openxmlformats-officedocument.presentationml.slide',
        'application/vnd.ms-powerpoint.slide.macroEnabled.12',
        'application/onenote',
        'application/vnd.oasis.opendocument.text',
        'application/vnd.oasis.opendocument.presentation',
        'application/vnd.oasis.opendocument.spreadsheet',
        'application/vnd.oasis.opendocument.graphics',
        'application/vnd.oasis.opendocument.chart',
        'application/vnd.oasis.opendocument.database',
        'application/vnd.oasis.opendocument.formula',
        'application/wordperfect',
        'application/vnd.apple.keynote',
        'application/vnd.apple.numbers',
        'application/vnd.apple.pages',
    ];

    /**
     * @param string $mimeType
     *
     * @return bool
     */
    public function isImage(string $mimeType): bool
    {
        return strpos($mimeType, 'image/') !== false;
    }

    /**
     * @param string $mimeType
     *
     * @return bool
     */
    public function isText(string $mimeType): bool
    {
        return (strpos($mimeType, 'text/') !== false || in_array($mimeType, $this->textMimeType));
    }

    /**
     * @param string $mimeType
     *
     * @return bool
     */
    public function isAudio(string $mimeType): bool
    {
        return strpos($mimeType, 'audio/') !== false;
    }

    /**
     * @param string $mimeType
     *
     * @return bool
     */
    public function isVideo(string $mimeType): bool
    {
        return strpos($mimeType, 'video/') !== false;
    }

    /**
     * @param string $mimeType
     *
     * @return string
     */
    public function getType($mimeType)
    {
        if ($this->isVideo($mimeType)) {
            return self::TYPE_VIDEO;
        } else if ($this->isImage($mimeType)) {
            return self::TYPE_IMAGE;
        } else if ($this->isAudio($mimeType)) {
            return self::TYPE_AUDIO;
        } else if ($this->isText($mimeType)) {
            return self::TYPE_TEXT;
        }

        return null;
    }
} 