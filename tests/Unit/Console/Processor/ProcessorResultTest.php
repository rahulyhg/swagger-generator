<?php
namespace Tests\Unit\Console\Processor;

use Weburnit\Console\Commands\Processor\ProcessorResult;
use Weburnit\Console\Commands\Processor\Validations\ValidationFactory;

class ProcessorResultTest extends \PHPUnit_Framework_TestCase
{
    public function testToStringForExtendedField()
    {
        $result = new ProcessorResult(
            'platformCode',
            new ProcessorResult(
                ValidationFactory::EXTENDED_TYPE_EXISTS,
                new ProcessorResult('product,platformCode', new ProcessorResult(ValidationFactory::TYPE_STRING))
            )
        );
        $result->setDescription('platform code');
        $result->setRequired(true);
        static::assertEquals(
            'exists:product,platformCode|string|required',
            (string) $result,
            'Must reflect correct validation'
        );
    }

    public function testToStringForPrimitiveField()
    {
        $result = new ProcessorResult(
            'price',
            new ProcessorResult(
                ValidationFactory::TYPE_NUMERIC
            )
        );
        $result->setRequired(true);
        $result->setDescription('Order price');

        static::assertEquals('numeric|required', (string) $result);
    }
}
