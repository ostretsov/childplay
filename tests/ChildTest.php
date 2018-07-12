<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 12.07.18 8:25.
 */

namespace App\Tests;

use App\Child;
use PHPUnit\Framework\TestCase;

class ChildTest extends TestCase
{
    public function testCreateSophia()
    {
        $child = new Child('Sophia', new \DateTimeImmutable('2012-10-05'));

        $this->assertSame('Sophia', $child->getName());
        $this->assertEquals('2012-10-05', $child->getBirthday()->format('Y-m-d'));
    }
}
