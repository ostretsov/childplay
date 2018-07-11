<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 11.07.18 8:06.
 */

namespace App\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user_account_child")
 */
class UserChild
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\User\Entity\User", inversedBy="children")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60)
     */
    private $name;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="birthday", type="datetimetz_immutable")
     */
    private $birthday;

    public function __construct(User $user, string $name, \DateTimeImmutable $birthday)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->user = $user;
        $this->name = $name;
        $this->birthday = $birthday;
    }
}
