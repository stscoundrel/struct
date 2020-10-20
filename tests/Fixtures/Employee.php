<?php
/**
 * Employee struct.
 *
 * @package Structs.
 */

namespace Silvanus\Structs\Tests\Fixtures;

// Parent class.
use Silvanus\Structs\AbstractStruct;

/**
 * Sample struct for tests.
 */
class Employee extends AbstractStruct
{

    /**
     * Employee name.
     *
     * @var string.
     */
    public $name;

    /**
     * Employee department.
     *
     * @var string.
     */
    public $department;

    /**
     * Employee salary.
     *
     * @var int.
     */
    public $salary;
}
