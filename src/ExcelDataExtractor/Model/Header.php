<?php


namespace Val\ExcelDataExtractor\Model;


class Header
{
    private $name;
    private $values = [];

    public static function initHeaders(array $headers): array
    {
        $return = [];

        foreach ($headers as $key => $name) {
            $return[$key] = new self($name);
        }

        return $return;
    }

    public function __construct(?string $name = null)
    {
        if ($name) {
            $this->name = $name;
        }
    }

    public function __toString(): string
    {
        return (string) $this->name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function addValue(?string $value): self
    {
        if (!in_array($value, $this->values, true)) {
            $this->values[] = $value;
        }

        return $this;
    }

    public function setValues(array $values): self
    {
        $this->values = $values;

        return $this;
    }
}