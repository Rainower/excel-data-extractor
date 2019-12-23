Excel Data Extractor
===================
Excel Data Extractor crawl an Excel file and extracts the header and data of a table inside.

Installation
------------
```bash
$ composer require valentinloiseau/excel-data-extractor
```

Usage
-----
```php
$crawler = new Crawler('path/to/my/file.xlsx');

# Make some adjustments
Configuration::setLineAttributesFromHeader(true);

$table = $crawler->getTable();
$headers = $table->getHeaders();
$lines = $table->getLines();
```

Configuration
-------------
**Call the following static methods to class ```Configuration```:**

## `setIgnoreBlankLines`

Default to ```true```.

Set to ```false``` to get all table lines, included blank lines.

## `setLineAttributesFromHeader`

Default to ```false```.

By default, cell values are stored in the corresponding string column index property, *eg:* if the first cell value of current line if 'bar' the result will be ```'A' => 'bar'```.

For the same example if this configuration is set to ```true``` and the guessed column name is 'foo' the result will be ```'foo' => 'bar'```.