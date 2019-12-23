<?php


namespace Val\ExcelDataExtractor;


class Configuration
{
    private static $ignoreBlankLines = true;
    private static $lineAttributesFromHeader = false;

    public static function isIgnoreBlankLines(): bool
    {
        return self::$ignoreBlankLines;
    }

    public static function setIgnoreBlankLines(bool $ignoreBlankLines): void
    {
        self::$ignoreBlankLines = $ignoreBlankLines;
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