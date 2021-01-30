<?php

namespace Silvanus\Structs\Tests;

use PHPUnit\Framework\TestCase;

// Struct deps.
use Silvanus\Structs\AbstractStructImmutable;

// Struct exceptions.
use Silvanus\Structs\Exceptions\CanNotSetPropertyException;
use Silvanus\Structs\Exceptions\CanNotGetPropertyException;

// Fixtures.
use Silvanus\Structs\Tests\Fixtures\EmployeeImmutable;

final class StructImmutableTest extends TestCase
{

    /**
     * Instance can be created.
     *
     * @return void
     */
    public function testCanCreateInstance(): void
    {
        $this->assertInstanceOf(
            AbstractStructImmutable::class,
            new EmployeeImmutable()
        );
    }

    /**
     * Can populate props with array.
     *
     * @return void
     */
    public function testCanPopulatePropsInConstruct(): void
    {
        $props = array(
            'name'       => 'Eiríkr inn Rauda',
            'department' => 'Greenland',
            'salary'     => 1003
        );

        $employee = new EmployeeImmutable($props);

        $this->assertEquals(
            'Eiríkr inn Rauda',
            $employee->name
        );

        $this->assertEquals(
            'Greenland',
            $employee->department
        );

        $this->assertEquals(
            1003,
            $employee->salary
        );
    }

    /**
     * Throws error if constructor array has illegal properties.
     *
     * @return void
     */
    public function testThrowsErrorInIllegalConstructorProperties(): void
    {
        $this->expectException(CanNotSetPropertyException::class);

        $props = array(
            'name'       => 'Eiríkr inn Rauda',
            'department' => 'Greenland',
            'salary'     => 1003,
            'profession' => 'Explorer',
        );

        $employee = new EmployeeImmutable($props);
    }

    /**
     * Throws error on illegal set.
     *
     * @return void
     */
    public function testPropertyCannotBeChanged(): void
    {
        $this->expectException(CanNotSetPropertyException::class);

        $props = array(
            'name'       => 'Eiríkr inn Rauda',
            'department' => 'Greenland',
            'salary'     => 1003,
        );

        $employee = new EmployeeImmutable($props);
        $employee->name = 'Eiríkr';
    }

    /**
     * Throws error on illegal set.
     *
     * @return void
     */
    public function testPropertiesCannotBeAdded(): void
    {
        $this->expectException(CanNotSetPropertyException::class);

        $props = array(
            'name'       => 'Eiríkr inn Rauda',
            'department' => 'Greenland',
            'salary'     => 1003,
        );

        $employee = new EmployeeImmutable($props);
        $employee->relatives = array();
    }

    /**
     * Throws error on illegal set.
     *
     * @return void
     */
    public function testNotExistingPropertiesCannotBeUsed(): void
    {
        $this->expectException(CanNotGetPropertyException::class);

        $employee = new EmployeeImmutable(array());
        $relatives = $employee->relatives;
    }
}
