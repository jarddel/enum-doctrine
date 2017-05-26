<?php
namespace Robusto\EnumType\Tests;

use Doctrine\DBAL\Types\Type;

class EnumTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        Type::addType('language', LanguageEnum::class);
    }

    public function testIdentity()
    {
        $this->assertEquals(1, LanguageEnum::JAVA);
    }

    public function testDescription()
    {
        $this->assertEquals('Javascript', (string) LanguageEnum::JS());
    }

    public function testMatchDescriptions()
    {
        $this->assertSameSize(LanguageEnum::getValues(), LanguageEnum::getDescriptions());
    }

    public function testInstance()
    {
        $this->assertInstanceOf(LanguageEnum::class, LanguageEnum::PHP());
    }

    public function testValue()
    {
        $this->assertEquals(3, LanguageEnum::PYTHON()->getValue());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidValue()
    {
        LanguageEnum::DELPHI();
    }
}
