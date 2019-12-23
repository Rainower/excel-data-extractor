<?php


namespace Val\ExcelDataExtractor;


use PhpOffice\PhpSpreadsheet\IOFactory;
use Val\ExcelDataExtractor\Exception\Exception;
use Val\ExcelDataExtractor\Model\Header;
use Val\ExcelDataExtractor\Model\Line;
use Val\ExcelDataExtractor\Model\Table;

class Crawler
{
    private $table;

    public function crawl()
    {
        if (!Configuration::getFile()) {
            throw new Exception('You must provide file path. Try Rainower\ExcelDataExtractor\Configuration::setFile(\'path/to/my/file.xlsx\').');
        }

        $this->table = new Table();

        $reader = IOFactory::createReaderForFile(Configuration::getFile());
        $spreadsheet = $reader->load(Configuration::getFile());
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($sheet->getRowIterator() as $row) {
            $line = new Line();

            foreach ($row->getCellIterator() as $cell) {
                $line->addValue($cell->getColumn(), $cell->getValue(), $this->table);
            }

            if (!$this->table->getHeaders() && $line->isFull()) {
                $this->table->setHeaders(Header::initHeaders((array) $line));
            } elseif ($this->table->getHeaders() && (!Configuration::isIgnoreBlankLines() || !$line->isBlank())) {
                $this->table->addLine($line);
            }
        }
    }

    public function getTable(): Table
    {
        if (!$this->table) {
            $this->crawl();
        }

        return $this->table;
    }
}