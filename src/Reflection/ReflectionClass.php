<?php

declare(strict_types = 1);

namespace Elephant\Reflection;

use \ReflectionClass as PhpReflectionClass;

class ReflectionClass extends PhpReflectionClass {
    public function __construct($objectOrClass)
    {
        parent ::__construct($objectOrClass);
    }
}