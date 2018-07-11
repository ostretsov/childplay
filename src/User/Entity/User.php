<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 11.07.18 8:01.
 */

namespace App\User\Entity;

use App\User\PasswordEncoderInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user_account")
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="string", length=40)
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=40)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="encoded_password", type="string", length=60)
     */
    private $encodedPassword;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\User\Entity\UserChild", mappedBy="user")
     */
    private $children;

    public function __construct(string $login, PasswordEncoderInterface $encoder, string $rawPassword)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->login = $login;
        $this->encodedPassword = $encoder->encode($rawPassword);
        $this->children = new ArrayCollection();
    }

    public function isPasswordValid(string $rawPassword, PasswordEncoderInterface $encoder): bool
    {
        return $encoder->encode($rawPassword) === $this->encodedPassword;
    }
}
