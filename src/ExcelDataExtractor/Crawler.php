<?php


namespace Rainower\ExcelDataExtractor;


use PhpOffice\PhpSpreadsheet\IOFactory;

class Crawler
{
    private $header = [];
    private $lines = [];

    public function crawl()
    {
        if (!Configuration::getFile()) {
            throw new Exception('You must provide file path. Try Rainower\ExcelDataExtractor\Configuration::setFile(\'path/to/my/file.xlsx\').');
        }

        $reader = IOFactory::createReaderForFile(Configuration::getFile());
        $spreadsheet = $reader->load(Configuration::getFile());
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($sheet->getRowIterator() as $row) {
            $line = new Line();

            foreach ($row->getCellIterator() as $cell) {
                $column = $this->header && Configuration::isLineAttributesFromHeader() ? $this->header[$cell->getColumn()] : $cell->getColumn();
                $line->$column = $cell->getValue();
            }

            if (!$this->header && $line->isFull()) {
                $this->header = (array) $line;
            } elseif ($this->header && !$line->isBlank()) {
                $this->lines[] = $line;
            }
        }
    }

    public function getHeader(): ?array
    {
        if (!$this->header) {
            $this->crawl();
        }

        return $this->header;
    }

    public function getLines(): ?array
    {
        if (!$this->lines) {
            $this->crawl();
        }

        return $this->lines;
    }
}