<?php


namespace Rainower\ExcelDataExtractor;


class Configuration
{
    private static $file;
    private static $lineAttributesFromHeader = false;

    public static function getFile(): ?string
    {
        return self::$file;
    }

    public static function setFile(string $file): void
    {
        if (!file_exists($file)) {
            throw new Exception("File $file does not exist.");
        }

        self::$file = $file;
    }

    public static function isLineAttributesFromHeader(): bool
    {
        return self::$lineAttributesFromHeader;
    }

    public static function setLineAttributesFromHeader(bool $lineAttributesFromHeader): void
    {
        self::$lineAttributesFromHeader = $lineAttributesFromHeader;
    }
}