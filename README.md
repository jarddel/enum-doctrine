Robusto EnumType!
=============
A robust and simple way to define enumerative in php using Doctrine 2 Types.

<table width="890"><tr>
    <td width="116" align="center"><b>Scrutinizer</b></td>
    <td width="142" align="center"><b>Code Quality</b></td>
    <td width="122" align="center"><b>Latest</b></td>
    <td width="142" align="center"><b>Development</b></td>
    <td width="108" align="center"><b>PHP</b></td>
    <td width="110" align="center"><b>License</b></td>
</tr>
<tr>
    <td valign="top" width="136" align="center">
        <a href="https://scrutinizer-ci.com/g/jarddel/enum-type/build-status/master">
            <img src="https://scrutinizer-ci.com/g/jarddel/enum/badges/build.png?b=master&cache=none">
	</a>
    </td>
    <td valign="top" width="230" align="center">
        <a href="https://scrutinizer-ci.com/g/jarddel/enum-type/?branch=master">
            <img src="https://scrutinizer-ci.com/g/jarddel/enum/badges/quality-score.png?b=master">
	</a>
        <a href="https://www.codacy.com/app/jarddel/enum-type">
            <img src="https://api.codacy.com/project/badge/Grade/a4f78b13d720474da8e0fcc6e7343710">
	</a>
    </td>
    <td valign="top" width="132" align="center">
        <a href="https://packagist.org/packages/robusto/enum-type">
	    <img src="https://poser.pugx.org/robusto/enum/v/stable">
	</a>
    </td>
    <td valign="top" width="152" align="center">
        <a href="https://packagist.org/packages/robusto/enum-type">
	    <img src="https://poser.pugx.org/robusto/enum/v/unstable">
	</a>
    </td>
    <td valign="top" width="143" align="center">
        <a href="https://php.net/">
	    <img src="https://img.shields.io/badge/PHP-%3E%3D%207.0-8892BF.svg">
	</a>
    </td>
    <td valign="top" width="110" align="center">
        <a href="https://packagist.org/packages/robusto/enum-type">
	    <img src="https://poser.pugx.org/robusto/enum/license">
	</a>
    </td>
</tr></table>

##### Requirements:
- PHP 7.0+
- [Robusto Enum] (https://github.com/jarddel/enum)
- [DBAL](https://github.com/doctrine/dbal)

<br />
=============
#### Can be used along with [DBAL](https://github.com/doctrine/dbal) (Database Abstraction Layer). To work on the concept of types:
=============
A Simple Example:
```php
class DayWeekEnum extends EnumType
{
	const SUNDAY    = 1,
	      MONDAY    = 2,
	      TUESDAY   = 3,
	      WEDNESDAY = 4,
	      THURSDAY  = 5,
	      FRIDAY    = 6,
	      SATURDAY  = 7
    ;
}
```

Adding types to configurations:

```yml
doctrine:
   dbal:
       types:
           day_week: DayweekEnum
```
Using types with annotation:

```php

/** @Entity */
class Foo
{
    /** @Column(type="integer") */
    private $id;

    /** @Column(type="day_week", name="day_week") */
    private $day;
}
```

Using types with XML:
```xml
<entity name="Foo" table="foo">
    <id name="id" column="id" type="integer" />
    <field name="day" column="day_week" type="day_week" />
</entity>
```


