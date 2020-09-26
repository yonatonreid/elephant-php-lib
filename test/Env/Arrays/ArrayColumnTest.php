<?php

declare(strict_types=1);

namespace ElephantTest\Env\Arrays;

use Elephant\Env\Arrays;
use PHPUnit\Framework\TestCase;


class ArrayColumnTest extends TestCase
{
    public function testCanReturnColumns()
    {
        $records = array(
            array(
                'id' => 2135,
                'first_name' => 'John',
                'last_name' => 'Doe',
            ),
            array(
                'id' => 3245,
                'first_name' => 'Sally',
                'last_name' => 'Smith',
            ),
            array(
                'id' => 5342,
                'first_name' => 'Jane',
                'last_name' => 'Jones',
            ),
            array(
                'id' => 5623,
                'first_name' => 'Peter',
                'last_name' => 'Doe',
            )
        );
        $expected = ['John', 'Sally', 'Jane', 'Peter'];
        $this -> assertEquals($expected, Arrays ::arrayColumn($records, 'first_name'));
    }

    public function testCanReturnColumnsWithKeyIndex()
    {
        $records = array(
            array(
                'id' => 2135,
                'first_name' => 'John',
                'last_name' => 'Doe',
            ),
            array(
                'id' => 3245,
                'first_name' => 'Sally',
                'last_name' => 'Smith',
            ),
            array(
                'id' => 5342,
                'first_name' => 'Jane',
                'last_name' => 'Jones',
            ),
            array(
                'id' => 5623,
                'first_name' => 'Peter',
                'last_name' => 'Doe',
            )
        );
        $expected = [2135 => 'Doe', 3245 => 'Smith', 5342 => 'Jones', 5623 => 'Doe'];
        $this -> assertEquals($expected, Arrays ::arrayColumn($records, 'last_name','id'));
    }

    public function testCanReturnObjectColumns()
    {
        $users = [
            new TestArrayColumnUser('user 1'),
            new TestArrayColumnUser('user 2'),
            new TestArrayColumnUser('user 3'),
        ];
        $expected = ['user 1', 'user 2', 'user 3'];
        $this -> assertEquals($expected, Arrays ::arrayColumn($users, 'username'));
    }

    public function testCanReturnColumnsWithAccessPrivateObjectMemberWithMagicMethods()
    {
        $users = [
            new TestArrayColumnPerson('user 1'),
            new TestArrayColumnPerson('user 2'),
            new TestArrayColumnPerson('user 3'),
        ];
        $expected = ['user 1', 'user 2', 'user 3'];
        $this -> assertEquals($expected, Arrays ::arrayColumn($users, 'name'));
    }
}


class TestArrayColumnUser
{
    public $username;

    public function __construct(string $username)
    {
        $this -> username = $username;
    }
}

class TestArrayColumnPerson
{
    private $name;

    public function __construct(string $name)
    {
        $this -> name = $name;
    }

    public function __get($prop)
    {
        return $this -> $prop;
    }

    public function __isset($prop): bool
    {
        return isset($this -> $prop);
    }
}