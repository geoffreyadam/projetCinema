<?php

namespace App\Entity;

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
     * @ORM\OneToOne(targetEntity="App\Entity\Room", cascade={"persist", "remove"})
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
        return $this->getRoom();
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
}
