<?php
namespace Robusto\EnumType;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Robusto\Enum\EnumTrait;
use Robusto\Enum\EnumInterface;
use \ReflectionClass;

/**
 * Abstract class for enumerations, which can be used along with DBAL (Database Abstraction Layer)
 * To work on the concept of types.
 *
 * @author Jarddel Antunes
 * @package Robusto\EnumType
 * @copyright 2017 Robusto Enum
 */
abstract class Enum extends Type implements EnumInterface
{
    use EnumTrait;

    /**
     *
     * {@inheritDoc}
     * @see \Doctrine\DBAL\Types\Type::getSQLDeclaration()
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        static::assignValues();

        return "ENUM(".implode(", ", static::$descriptions ? : static::$values).")";
    }

    /**
     *
     * {@inheritDoc}
     * @see \Doctrine\DBAL\Types\Type::convertToPHPValue()
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return static::getEnumByDescription($value);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Doctrine\DBAL\Types\Type::getName()
     */
    public function getName()
    {
        return static::class;
    }

    /**
     * Get the instance of the enumerative class
     *
     * @return EnumInterface
     */
    protected static function getInstance(int $value, string $description = null): EnumInterface
    {
        $type = strtolower(preg_replace(['(.*[\\\/])','/Enum|Type/','/(?<!^)[A-Z]/'], ['','','_$0'], static::class));
        $instance = clone static::getType($type);
        static::setInstanceValue($instance, $value);
        static::setInstanceDescription($instance, (string) $description);

        return $instance;
    }

    /**
     * Assigns the possible values ​​according to the enumerative class.
     */
    protected static function assignValues()
    {
        $valuesSubClass = array_values(static::getReflectionClass()->getConstants());
        $valuesSelfClass = array_values(static::getReflectionClass(self::class)->getConstants());

        static::$values = array_diff($valuesSubClass, $valuesSelfClass);
    }

    /**
     * Assigns the constants of the enumerative class.
     */
    protected static function assignConstants()
    {
        $constantsSubClass = array_keys(static::getReflectionClass()->getConstants());
        $constantsSelfClass = array_keys(static::getReflectionClass(self::class)->getConstants());

        static::$constants = array_diff($constantsSubClass, $constantsSelfClass);
    }

    /**
     *
     * @param EnumInterface $instance
     * @param int $value
     * @return EnumInterface
     */
    private static function setInstanceValue(EnumInterface &$instance, int $value)
    {
        $class = static::getReflectionClass();
        $property = $class->getProperty('value');
        $property->setAccessible(true);
        $property->setValue($instance, $value);
        $property->setAccessible(false);
    }

    /**
     *
     * @param EnumInterface $instance
     * @param string $description
     */
    private static function setInstanceDescription(EnumInterface &$instance, string $description)
    {
        $class = static::getReflectionClass();
        $property = $class->getProperty('description');
        $property->setAccessible(true);
        $property->setValue($instance, $description);
        $property->setAccessible(false);
    }

    /**
     *
     * @param string $class
     * @return ReflectionClass
     */
    private static function getReflectionClass(string $class = null): ReflectionClass
    {
        return new ReflectionClass($class ?? static::class);
    }
}
