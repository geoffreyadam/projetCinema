<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScreeningRepository")
 */
class Screening
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Room;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Room")
     */
    private $room;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Movie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $movietitle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Movie", inversedBy="Screening")
     * @ORM\JoinColumn(nullable=false)
     */
    private $movie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="screening")
     */
    private $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoom(): ?string
    {
        return $this->Room;
    }

    public function setRoom(string $Room): self
    {
        $this->Room = $Room;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMovietitle(): ?Movie
    {
        return $this->movietitle;
    }

    public function setMovietitle(?Movie $movietitle): self
    {
        $this->movietitle = $movietitle;

        return $this;
    }
    public function __toString(){
        return $this->getRoom() . ' - ' . $this->getDate()->format('Y-m-d') . ' - ' . $this->getMovie();
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setScreening($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getScreening() === $this) {
                $reservation->setScreening(null);
            }
        }

        return $this;
    }
}
