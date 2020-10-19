<?php
/**
 * CanNotSetProperty exception.
 *
 * @package Structs.
 */

namespace Silvanus\Structs\Exceptions;

use \Exception;

/**
 * Handle exception for using non-allowed class property.
 */
class CanNotSetPropertyException extends Exception
{
    protected $message = 'Can not set non-declared struct property.' ;
}
