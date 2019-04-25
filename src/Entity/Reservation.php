<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\Column(type="integer")
     */
    private $Capacity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Screening", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $screening;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }



    public function getCapacity(): ?int
    {
        return $this->Capacity;
    }

    public function setCapacity(int $Capacity): self
    {
        $this->Capacity = $Capacity;

        return $this;
    }

    public function getScreening(): ?Screening
    {
        return $this->screening;
    }

    public function setScreening(?Screening $screening): self
    {
        $this->screening = $screening;

        return $this;
    }
}
