<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 14.07.18 8:04.
 */

namespace App\Tests\Fixtures;

use App\Child;
use App\User;

class JohnDoeUserStub extends User
{
    public function __construct()
    {
        $mary = new Child('Mary', new \DateTimeImmutable('2011-12-02'));
        $garry = new Child('Garry', new \DateTimeImmutable('2013-03-23'));

        parent::__construct('John Doe', 'qwerty', [$mary, $garry]);
    }
}
