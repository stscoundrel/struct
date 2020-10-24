<?php
/**
 * AbstractStruct class
 *
 * @package Structs.
 */

namespace Silvanus\Structs;

// Exceptions.
use Silvanus\Structs\Exceptions\CanNotSetPropertyException;
use Silvanus\Structs\Exceptions\CanNotGetPropertyException;

/**
 * Serve as parent for all Struct classes.
 * Allow only in-class-declared properties to be used.
 */
abstract class AbstractStruct
{

    /**
     * Class constructor.
     * Can populate props from array.
     *
     * @param ?array $properties of Struct.
     */
    public function __construct(?array $properties = null)
    {
        if ($properties) :
            foreach ($properties as $property => $value) :
                $this->{$property} = $value;
            endforeach;
        endif;
    }

    /**
     * Stop getting of non-existing property.
     *
     * @param string $name of property.
     */
    final public function __get(string $name)
    {
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
