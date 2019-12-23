<?php


namespace Val\ExcelDataExtractor\Model;


class Table
{
    private $headers = [];
    private $lines = [];

    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    public function addHeader($key, Header $header): self
    {
        $this->headers[$key] = $header;

        return $this;
    }

    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    public function getLines(): array
    {
        return $this->lines;
    }

    public function addLine(Line $line): self
    {
        $this->lines[] = $line;

        return $this;
    }

    public function setLines(array $lines): self
    {
        $this->lines = $lines;

        return $this;
    }
}