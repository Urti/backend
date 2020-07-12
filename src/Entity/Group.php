<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Group
 * @package App/Entity
 * @ORM\Entity()
 * @ORM\Table(name="`group`")
 */
class Group
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Nazwa nie może być pusta")
     * @Assert\Length(max="255", maxMessage="Nazwa nie może mieć więcej niż 255 znaków")
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="text", length=65535, nullable=true)
     * @var string|null
     */
    private $info;

    /**
     * @ORM\Column(type="datetime")
     * @var date A "Y-m-d H:i:s" formatted value
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     * @var date A "Y-m-d H:i:s" formatted value
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="group")
     */
    private $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string:null
     */
    public function getInfo(): ?string
    {
        return $this->info;
    }

    /**
     * @param string $info
     */
    public function setInfo(?string $info): void
    {
        $this->info = $info;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setGroup($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getGroup() === $this) {
                $user->setGroup(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getName();
    }
}