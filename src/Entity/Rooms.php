<?php

namespace App\Entity;

use App\Repository\RoomsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomsRepository::class)
 */
class Rooms
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $r_number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $r_picture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRNumber(): ?int
    {
        return $this->r_number;
    }

    public function setRNumber(int $r_number): self
    {
        $this->r_number = $r_number;

        return $this;
    }

    public function getRPicture(): ?string
    {
        return $this->r_picture;
    }

    public function setRPicture(?string $r_picture): self
    {
        $this->r_picture = $r_picture;

        return $this;
    }
}
