<?php
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
     */
    public function testCanCreateInstance() {
        $this->assertInstanceOf(
            AbstractStruct::class,
            new Employee()
        );
    }

    /**
     * Can get and set allowed properties.
     */
    public function testCanGetAndSetAllowedProperties() {
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
     * Throws error on illegal set.
     */
    public function testThrowsErrorOnIllegalSet() {
        $this->expectException(CanNotSetPropertyException::class);

        $employee      = new Employee();
        $employee->age = 1100;
    }

    /**
     * Throws error on illegal set.
     */
    public function testThrowsErrorOnIllegalGet() {
        $this->expectException(CanNotGetPropertyException::class);
        
        $employee = new Employee();
        $status   = $employee->status;
    }
}
