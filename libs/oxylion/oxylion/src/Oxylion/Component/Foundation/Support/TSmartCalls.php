<?php declare(strict_types=1);
namespace Oxylion\Component\Foundation\Support;

use Oxylion\Component\Foundation\Exceptions\MemberAccessException;
use Oxylion\Component\Foundation\Exceptions\UnexpectedValueException;
use ReflectionException;

/**
 * @className TSmartCalls
 * Strict class for better experience.
 * - 'did you mean' hints
 * - access to undeclared members throws exceptions
 * - support for @property annotations
 * - support for calling event handlers stored in $onEvent via onEvent()
 */
trait TSmartCalls
{
    /**
     * @throws MemberAccessException
     * @throws ReflectionException
     */
    public function __call(string $name, array $args)
    {
        $class = static::class;

        if (ObjectUtils::hasProperty($class, $name) === 'event') { // calling event handlers
            $handlers = $this->$name ?? null;
            if (is_iterable($handlers)) {
                foreach ($handlers as $handler) {
                    $handler(...$args);
                }
            } elseif ($handlers !== null) {
                throw new UnexpectedValueException("Property $class::$$name must be iterable or null, " . gettype($handlers) . ' given.');
            }

        } else {
            ObjectUtils::strictCall($class, $name);
        }
    }


    /**
     * @param string $name
     * @param array $args
     * @throws ReflectionException
     */
    public static function __callStatic(string $name, array $args)
    {
        ObjectUtils::strictStaticCall(static::class, $name);
    }


    /**
     * @param string $name
     * @return mixed
     * @throws ReflectionException
     */
    public function &__get(string $name)
    {
        $class = static::class;

        if ($prop = ObjectUtils::getMagicProperties($class)[$name] ?? null) { // property getter
            if (!($prop & 0b0001)) {
                throw new MemberAccessException("Cannot read a write-only property $class::\$$name.");
            }
            $m = ($prop & 0b0010 ? 'get' : 'is') . $name;
            if ($prop & 0b0100) { // return by reference
                return $this->$m();
            } else {
                $val = $this->$m();
                return $val;
            }
        } else {
            ObjectUtils::strictGet($class, $name);
        }
    }


    /**
     * @param string $name
     * @param mixed $value
     * @return void
     * @throws ReflectionException
     */
    public function __set(string $name, $value)
    {
        $class = static::class;

        if (ObjectUtils::hasProperty($class, $name)) { // unsetted property
            $this->$name = $value;

        } elseif ($prop = ObjectUtils::getMagicProperties($class)[$name] ?? null) { // property setter
            if (!($prop & 0b1000)) {
                throw new MemberAccessException("Cannot write to a read-only property $class::\$$name.");
            }
            $this->{'set' . $name}($value);

        } else {
            ObjectUtils::strictSet($class, $name);
        }
    }


    /**
     * @param string $name
     * @return void
     */
    public function __unset(string $name)
    {
        $class = static::class;
        if (!ObjectUtils::hasProperty($class, $name)) {
            throw new MemberAccessException("Cannot unset the property $class::\$$name.");
        }
    }


    public function __isset(string $name): bool
    {
        return isset(ObjectUtils::getMagicProperties(static::class)[$name]);
    }
}