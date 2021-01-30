<?php
/**
 * Employee struct.
 *
 * @package Structs.
 */

namespace Silvanus\Structs\Tests\Fixtures;

// Parent class.
use Silvanus\Structs\AbstractStructImmutable;

/**
 * Sample struct for tests.
 */
class EmployeeImmutable extends AbstractStructImmutable
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
