<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusRepository::class)
 */
class Status
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
    private $s_condition;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSCondition(): ?string
    {
        return $this->s_condition;
    }

    public function setSCondition(string $s_condition): self
    {
        $this->s_condition = $s_condition;

        return $this;
    }
}
