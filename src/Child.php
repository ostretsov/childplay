<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 12.07.18 8:19.
 */

namespace App;

class Child
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var \DateTimeImmutable
     */
    private $birthday;

    public function __construct(string $name, \DateTimeImmutable $birthday)
    {
        $this->name = $name;
        $this->birthday = $birthday;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBirthday(): \DateTimeImmutable
    {
        return $this->birthday;
    }
}
