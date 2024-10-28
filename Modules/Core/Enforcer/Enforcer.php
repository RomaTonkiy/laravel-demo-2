<?php

namespace Modules\Core\Enforcer;

use Exception;
use ReflectionClass;
use ReflectionException;

class Enforcer {
    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public static function __add($class, $c): void
    {
        $reflection = new ReflectionClass($class);
        $constantsForced = $reflection->getConstants();
        foreach ($constantsForced as $constant => $value) {
            if (constant("$c::$constant") == "abstract") {
                throw new Exception("Undefined $constant in " . (string) $c);
            }
        }
    }
}
