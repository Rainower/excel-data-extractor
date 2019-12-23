<?php


namespace Rainower\ExcelDataExtractor;


class Line
{
    public function isBlank(): bool
    {
        foreach ($this as $attribute) {
            if (null !== $attribute) {
                return false;
            }
        }

        return true;
    }

    public function isFull(): bool
    {
        foreach ($this as $attribute) {
            if (null === $attribute) {
                return false;
            }
        }

        return true;
    }
}