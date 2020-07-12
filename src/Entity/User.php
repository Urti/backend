<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="`person`")
 * @UniqueEntity("login", message="Już taki login istnieje!")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned"=true,"unique"=true})
     */
    private $id;

    /**
     * @Assert\Length(max="100", min="2", minMessage="Login musi mieć minimum 2 znaki", maxMessage="Login nie może mieć więcej niż 100 znaków")
     * @ORM\Column(type="string", length=100, options={"unique"=true})
     * @var string
     */
    private $login;

    /**
     * @Assert\NotBlank(message="Nazwisko nie może być puste")
     * @ORM\Column(type="string")
     * @var string
     */
    private $last_name;

    /**
     * @Assert\NotBlank(message="Imię nie może być puste")
     * @ORM\Column(type="string")
     * @var string
     */
    private $first_name;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Group", inversedBy="user")
     */
    private $group;

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
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
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

    public function getGroup(): ?Group
    {
        return $this->group;
    }

    public function setGroup(?Group $group): self
    {
        $this->group = $group;

        return $this;
    }
}