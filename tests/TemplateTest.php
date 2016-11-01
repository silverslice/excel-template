<?php

namespace Silverslice\DocxTemplate\Tests;

use Silverslice\ExcelTemplate\Template;

class TemplateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Exception
     */
    public function testOpenFail()
    {
        $template = new Template();

        $template->open('testFail.xlsx');
    }

    /**
     * @expectedException \Exception
     */
    public function testSaveFail()
    {
        $template = new Template();

        $template
            ->open(__DIR__ . '/test.xlsx')
            ->save(__DIR__ . '/dir/test.xlsx');
    }

    public function testReplace()
    {
        if (!is_dir(__DIR__ . '/output')) {
            mkdir(__DIR__ . '/output');
        }
        $replacedFile = __DIR__ . '/output/test2.xlsx';

        $template = new Template();

        $template
            ->open(__DIR__ . '/test.xlsx')
            ->replace('name', '#Composer#')
            ->replace('head', '#management#')
            ->replace('library', '#libraries#')
            ->save($replacedFile);

        $this->assertFileExists($replacedFile);

        $contents = $this->getDocxContents($replacedFile);
        $this->assertEquals(1, substr_count($contents, '#Composer#'));
        $this->assertEquals(1, substr_count($contents, '#management#'));
        $this->assertEquals(2, substr_count($contents, '#libraries#'));
    }

    protected function getDocxContents($file)
    {
        $zip = new \ZipArchive();
        $zip->open($file);
        $contents = $zip->getFromName('xl/sharedStrings.xml');
        $zip->close();

        return $contents;
    }
}