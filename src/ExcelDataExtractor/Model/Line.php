<?php


namespace Val\ExcelDataExtractor\Model;


use Val\ExcelDataExtractor\Configuration;
use Val\ExcelDataExtractor\Exception\Exception;

class Line
{
    public function addValue(string $column, $value, Table $table): self
    {
        $attribut = $column;

        if ($table->getHeaders() && Configuration::isLineAttributesFromHeader()) {
            if (!isset($table->getHeaders()[$column])) {
                throw new Exception("Column $column does not exist.");
            }

            $attribut = $table
                ->getHeaders()[$column]
                ->addValue($value);
        }

        $this->$attribut = $value;

        return $this;
    }

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