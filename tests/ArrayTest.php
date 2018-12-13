<?php

namespace Berlioz\Utils\Tests;

use PHPUnit\Framework\TestCase;

class ArrayTest extends TestCase
{
    public function test_b_is_sequential_array()
    {
        $this->assertTrue(b_is_sequential_array(['foo', 'bar', 'hello', 'world']));
        $this->assertTrue(b_is_sequential_array([0 => 'foo', 1 => 'bar', 2 => 'hello', 3 => 'world']));
        $this->assertTrue(b_is_sequential_array([0 => 'foo', 2 => 'bar', 1 => 'hello', 3 => 'world']));
        $this->assertTrue(b_is_sequential_array(['0' => 'foo', '2' => 'bar', '1' => 'hello', '3' => 'world']));

        $this->assertFalse(b_is_sequential_array(['bar' => 'foo', 'foo' => 'bar', '1' => 'hello', '3' => 'world']));
        $this->assertFalse(b_is_sequential_array(['bar' => 'foo', 'foo' => 'bar', 1 => 'hello', 3 => 'world']));
        $this->assertFalse(b_is_sequential_array(['00' => 'foo', '01' => 'bar', '02' => 'hello', '03' => 'world']));
    }

    public function test_b_array_merge_recursive()
    {
        $arr1 = ['foo'  => 'hello',
                 'bar'  => 'world',
                 'test' => ['foo', 'bar', 'hello' => 'world']];
        $arr2 = ['test' => ['hello', 'foo']];
        $arr3 = ['foo' => 'world'];
        $arr4 = ['foo'  => 'world',
                 'test' => ['hello' => 'world2']];
        $arr5 = ['foo'  => 'world',
                 'test' => ['hello' => ['world2', 'world3']]];

        $this->assertEquals(['foo'  => 'hello',
                             'bar'  => 'world',
                             'test' => ['foo', 'bar', 'hello', 'foo', 'hello' => 'world']],
                            b_array_merge_recursive($arr1, $arr2));
        $this->assertEquals(['foo'  => 'world',
                             'bar'  => 'world',
                             'test' => ['foo', 'bar', 'hello' => 'world']],
                            b_array_merge_recursive($arr1, $arr3));
        $this->assertEquals(['foo'  => 'world',
                             'bar'  => 'world',
                             'test' => ['foo', 'bar', 'hello' => 'world2']],
                            b_array_merge_recursive($arr1, $arr4));
        $this->assertEquals(['foo'  => 'world',
                             'bar'  => 'world',
                             'test' => ['foo', 'bar', 'hello' => ['world2', 'world3']]],
                            b_array_merge_recursive($arr1, $arr5));
    }
}