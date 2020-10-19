<?php
/**
 * CanNotGetProperty exception.
 *
 * @package Structs.
 */

namespace Silvanus\Structs\Exceptions;

use \Exception;

/**
 * Handle exception for using non-allowed class property.
 */
class CanNotGetPropertyException extends Exception
{
    protected $message = 'Can not get non-declared struct property.' ;
}
