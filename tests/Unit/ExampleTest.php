<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        dump("aiueo");
        $this->assertTrue(true);
    }

    public function test_that_false_is_false(): void
    {
        $this->assertFalse(false);
    }
}
