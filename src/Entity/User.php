<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="`person`")
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
     * @ORM\Column(type="string", length=100, options={"unique"=true})
     * @var string
     */
    private $login;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $last_name;

    /**
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Group")
     * @var Group|null
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
    public function getLogin(): string
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

    /**
     * @return string
     */
    public function getLast_Name(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLast_Name(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getFirst_Name(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirst_Name(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return array
     */
    public function getCreated_At()
    {
        return $this->created_at;
    }

    /**
     * @param array $created_at
     */
    public function setCreated_At(DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string
     */
    public function getUpdated_At()
    {
        return $this->updated_at;
    }

    /**
     * @param string $updated_at
     */
    public function setUpdated_At(DateTime $updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return int:null
     */
    public function getGroup_id(): ?int
    {
        return $this->group;
    }

    /**
     * @param int:null $group
     */
    public function setGroup_id(string $group): void
    {
        $this->group = $group;
    }
}