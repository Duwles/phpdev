<?php
namespace Oxylion\Component\Foundation\Support;

use Error;
use Oxylion\Component\Foundation\Exceptions\MemberAccessException;
use ReflectionException;

trait InstanceUtils
{
    /** @throws Error */
    final public function __construct() {
        throw new Error('Class ' . static::class . ' is static and cannot be instantiated.');
    }

    /**
     * Call to undefined static method.
     * @param string $name
     * @param array $args
     * @return void
     * @throws ReflectionException
     */
    public static function __callStatic(string $name, array $args)
    {
        ObjectUtils::strictStaticCall(static::class, $name);
    }
}