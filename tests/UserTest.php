<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 12.07.18 8:13.
 */

namespace App\Tests;

use App\Child;
use App\Tests\Fixtures\JohnDoeUserStub;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCreateJohn()
    {
        $user = new JohnDoeUserStub();

        $this->assertSame('John Doe', $user->getName());
        $this->assertSame('qwerty', $user->getEncryptedPassword());
        $this->assertCount(2, $user->getChildren());
    }

    public function testAddChildAndGetChildren()
    {
        $user = new JohnDoeUserStub();
        $olivia = new Child('Olivia', new \DateTimeImmutable('2013-04-20'));

        $user->addChild($olivia);

        $this->assertCount(3, $user->getChildren());
    }
}
