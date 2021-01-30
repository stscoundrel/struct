<?php
/**
 * AbstractStructImmutable class
 *
 * @package Structs.
 */

namespace Silvanus\Structs;

// Exceptions.
use Silvanus\Structs\Exceptions\CanNotSetPropertyException;
use Silvanus\Structs\Exceptions\CanNotGetPropertyException;

// Core.
use ReflectionObject;
use ReflectionProperty;

/**
 * Serve as parent for all Immutable Struct classes.
 */
abstract class AbstractStructImmutable
{

    /**
     * Immutable properties stored in array.
     *
     * @var array.
     */
    protected $properties = array();

    /**
     * Class constructor.
     *
     * 1. Populate properties from array. Allows type checks.
     * 2. Add props to $properties array.
     * 3. Unset public properties. Serve from $properties arr instead.
     *
     * @param array $properties of Struct.
     */
    public function __construct(array $properties = [])
    {
        foreach ($properties as $property => $value) :
            if (property_exists($this, $property)) :
                $this->{$property} = $value;
                $this->properties[$property] = $value;
            else :
                throw new CanNotSetPropertyException();
            endif;
        endforeach;
        

        $this->blockProperties();
    }

    /**
     * Unset previously declared public properties.
     * They were only used for validation step.
     */
    protected function blockProperties()
    {
        $reflection = new ReflectionObject($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) :
            unset($this->{$property->name});
        endforeach;
    }

    /**
     * Get immutable property.
     * If exists, return.
     * If not, throw error.
     *
     * @param string $name of property.
     */
    final public function __get(string $name)
    {
        if (array_key_exists($name, $this->properties)) :
            return $this->properties[$name];
        endif;

        throw new CanNotGetPropertyException();
    }

    /**
     * Stop setting of dynamic properties.
     *
     * @param string $name of property.
     * @param mixed $value of property.
     */
    final public function __set(string $name, $value)
    {
        throw new CanNotSetPropertyException();
    }
}
