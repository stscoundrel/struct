# Structs

Structs for PHP. Simple data transfer objects.

### Install

Via Composer:

`composer require silvanus/structs`

To use autoloading mechanism, you must include `vendor/autoload.php` file in your code.

### Motivation

PHP does not have real structs. They are feature in many other languages like C++, Rust or Go. Typescripts interfaces also bear resemblence to structs. Structs would serve a purpose for simple data that has a shape, like data transfer objects.

In PHP you can't demand properties with Interfaces, only methods. Therefore interfaces for struct-like objects do not make much sense. But if you just use a class that has public properties, you'll still let clients just declare new properties on the fly. It would be preferable to keep the shape of data just the way the struct was defined.

This library aims to solve this by providing AbstractStruct class with sensible defaults to stop dynamically assigning new or incorrect class properties/members.

### Usage

Declare new struct.

```php
<?php

namespace YourNameSpace\Structs;

// Parent class.
use Silvanus\Structs\AbstractStruct;

class Employee extends AbstractStruct
{    
    public string $name;    
    public string $department;
    public int $salary;
}

```

Use the new struct

```php
<?php

use YourNameSpace\Structs\Employee;

$employee = new Employee();

// Set up data by property.
$employee->name       = 'Eiríkr Blóðøx';
$employee->department = 'Norway';
$employee->salary     = 954;

echo $employee->name; // Eiríkr Blóðøx

/**
 * You can only use properties set in class / struct level.
 */
$employee->hobbies = "Raiding"; // Throws CanNotSetPropertyException.
echo $employee->hobbies // Throws CanNotGetPropertyException

```

You can also populate the struct straight in creation.

```php
<?php

use YourNameSpace\Structs\Employee;

$data = array(
	'name' => 'Eiríkr Blóðøx',
	'department' => 'Norway',
	'salary' => 954,
	// Setting incorrect fields here will likewise throw exceptions.
);

$employee = new Employee($data);

```

### Immutable version

You can also use a version of struct that does not allow modification of data once it is set.

Create immutable struct:

```php
<?php

namespace YourNameSpace\Structs;

// Different parent class
use Silvanus\Structs\AbstractStructImmutable;

class EmployeeImmutable extends AbstractStructImmutable
{    
    public string $name;    
    public string $department;
    public int $salary;
}

```

Use immutable struct

```php
<?php

use YourNameSpace\Structs\EmployeeImmutable;

$data = array(
	'name' => 'Eiríkr Blóðøx',
	'department' => 'Norway',
	'salary' => 954,
	// Setting incorrect fields here will likewise throw exceptions.
);

$employee = new EmployeeImmutable($data);

// You can access the properties.
echo $employee->name;
echo $employee->department;
echo $employee->salary;

// ... But you cannot edit them.
$employee->name = 'Eiríkr inn rauða'; // Throws CanNotSetPropertyException.


```

### Whats the advantage over just using default class or an array

- You lock creation of additional properties. That way your data keeps the shape you expect it to have.
- You protect properties from typos. `$employee->salary` works, but `$employee->salayr` throws exception.
- Typehinting against `Employee $employee`

### How does it work?

Nothing fancy! Just writes `final __set` and `final __get` methods on abstract parent. They block getting & creating non-declared properties. Child classes can still add public properties, as calling a public property does not trigger `__get` or `__set`

The immutable version does things a bit differently. It first sets given properties in the public properties to trigger PHP type validation (if 7.4 or higher), but after that removes the values and only stores them in single array. `__get` automatically uses this `$properties` array to serve the values.
