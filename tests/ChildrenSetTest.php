<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 12.07.18 9:00.
 */

namespace App\Tests;

use App\ChildrenSet;
use PHPUnit\Framework\TestCase;

class ChildrenSetTest extends TestCase
{
    public function testCreateEmptySet()
    {
        $set = new ChildrenSet([]);

        $this->assertCount(0, $set);
    }
}
