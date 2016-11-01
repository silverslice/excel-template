Easy tool for replacing variables in xlsx documents
============================================================

## Why

If you try to create a simple template in PHPExcel, insert some data and save it as a new file,
you will see that conditional formatting is missing. PHPExcel is not a library for editing workbook files:
you're not using PHPExcel to change only one string in a file and save it in the same state.

## Install

`composer require silverslice/excel-template`

## Usage

Place variables in your xlsx-document as {foo}. Then replace them with `replace` method.

```php

use Silverslice\ExcelTemplate\Template;

require __DIR__ . '/vendor/autoload.php';

$template = new Template();

// open file
$template->open('test.xlsx')

    // replace one variable to another
    ->replace('one', 'two')

    // replace once more
    ->replace('foo', 'bar')

    // save document
    ->save('test.xlsx');
```