<?php

namespace Silvanus\Structs\Tests;

use PHPUnit\Framework\TestCase;

// Struct deps.
use Silvanus\Structs\AbstractStruct;

// Struct exceptions.
use Silvanus\Structs\Exceptions\CanNotSetPropertyException;
use Silvanus\Structs\Exceptions\CanNotGetPropertyException;

// Fixtures.
use Silvanus\Structs\Tests\Fixtures\Employee;

final class StructTest extends TestCase
{

    /**
     * Instance can be created.
     *
     * @return void
     */
    public function testCanCreateInstance(): void
    {
        $this->assertInstanceOf(
            AbstractStruct::class,
            new Employee()
        );
    }

    /**
     * Can get and set allowed properties.
     *
     * @return void
     */
    public function testCanGetAndSetAllowedProperties(): void
    {
        $employee             = new Employee();
        $employee->name       = 'Eiríkr Blóðøx';
        $employee->department = 'Norway';
        $employee->salary     = 954;

        $this->assertEquals(
            'Eiríkr Blóðøx',
            $employee->name
        );

        $this->assertEquals(
            'Norway',
            $employee->department
        );

        $this->assertEquals(
            954,
            $employee->salary
        );
    }

    /**
     * Can populate props with array.
     *
     * @return void
     */
    public function testPopulatePropsInConstruct(): void
    {
        $props = array(
            'name'       => 'Eiríkr Blóðøx',
            'department' => 'Norway',
            'salary'     => 954
        );

        $employee = new Employee($props);

        $this->assertEquals(
            'Eiríkr Blóðøx',
            $employee->name
        );

        $this->assertEquals(
            'Norway',
            $employee->department
        );

        $this->assertEquals(
            954,
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
            'name'       => 'Eiríkr Blóðøx',
            'department' => 'Norway',
            'salary'     => 954,
            'hobbies'    => 'Raiding',
        );

        $employee = new Employee($props);
    }

    /**
     * Throws error on illegal set.
     *
     * @return void
     */
    public function testThrowsErrorOnIllegalSet(): void
    {
        $this->expectException(CanNotSetPropertyException::class);

        $employee      = new Employee();
        $employee->age = 1100;
    }

    /**
     * Throws error on illegal set.
     *
     * @return void
     */
    public function testThrowsErrorOnIllegalGet(): void
    {
        $this->expectException(CanNotGetPropertyException::class);
        
        $employee = new Employee();
        $status   = $employee->status;
    }
}
