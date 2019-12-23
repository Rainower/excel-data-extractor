<?php


namespace Val\ExcelDataExtractor;


use PhpOffice\PhpSpreadsheet\IOFactory;
use Val\ExcelDataExtractor\Exception\Exception;
use Val\ExcelDataExtractor\Model\Header;
use Val\ExcelDataExtractor\Model\Line;
use Val\ExcelDataExtractor\Model\Table;

class Crawler
{
    private $file;
    private $table;

    public function __construct(string $file)
    {
        if (!file_exists($file)) {
            throw new Exception("File $file does not exist.");
        }

        $this->file = $file;
    }

    public function crawl()
    {
        $this->table = new Table();

        $reader = IOFactory::createReaderForFile($this->file);
        $spreadsheet = $reader->load($this->file);
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