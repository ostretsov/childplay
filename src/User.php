<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 12.07.18 8:18.
 */

namespace App;

class User
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $encryptedPassword;
    /**
     * @var array
     */
    private $children;

    public function __construct(string $name, string $encryptedPassword, array $children)
    {
        $this->name = $name;
        $this->encryptedPassword = $encryptedPassword;
        $this->children = $children;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEncryptedPassword(): string
    {
        return $this->encryptedPassword;
    }

    /**
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    public function addChild(Child $child): void
    {
        $this->children[] = $child;
    }
}
