<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 11.07.18 8:29.
 */

namespace App\Tests\User\Entity;

use App\User\Entity\User;
use App\User\PasswordEncoderInterface;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testConstructor()
    {
        $passwordEncoder = $this->createMock(PasswordEncoderInterface::class);
        $passwordEncoder->expects($this->once())
            ->method('encode')
            ->with('raw password');

        new User('login', $passwordEncoder, 'raw password');
    }
}
