<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 12.07.18 8:13.
 */

namespace App\Tests;

use App\Child;
use App\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @var User
     */
    private $user;

    protected function setUp()
    {
        $this->user = new User('John', 'password', [new Child('Mary', new \DateTimeImmutable('2011-12-02'))]);
    }

    public function testCreateJohn()
    {
        $this->assertSame('John', $this->user->getName());
        $this->assertSame('password', $this->user->getEncryptedPassword());
        $this->assertCount(1, $this->user->getChildren());
    }

    public function testAddChild()
    {
        $olivia = new Child('Olivia', new \DateTimeImmutable('2013-04-20'));

        $this->user->addChild($olivia);

        $this->assertCount(2, $this->user->getChildren());
    }
}
