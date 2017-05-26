<?php
namespace Robusto\EnumType\Tests;

use Robusto\EnumType\Enum;

class LanguageEnum extends Enum
{
    const JAVA   = 1,
          PHP    = 2,
          PYTHON = 3,
          RUBY   = 4,
          JS     = 5
    ;

    protected static $descriptions = [
        'Java',
        'PHP',
        'Python',
        'Ruby',
        'Javascript'
    ];
}