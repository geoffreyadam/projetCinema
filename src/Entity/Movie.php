<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
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
    private $Title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="integer")
     */
    private $Runtime;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Screening", mappedBy="movie")
     */
    private $Screening;

    public function __construct()
    {
        $this->Screening = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getRuntime(): ?int
    {
        return $this->Runtime;
    }

    public function setRuntime(int $Runtime): self
    {
        $this->Runtime = $Runtime;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }
    public function __toString(){
        return $this->getTitle();
    }

    /**
     * @return Collection|Screening[]
     */
    public function getScreening(): Collection
    {
        return $this->Screening;
    }

    public function addScreening(Screening $screening): self
    {
        if (!$this->Screening->contains($screening)) {
            $this->Screening[] = $screening;
            $screening->setMovie($this);
        }

        return $this;
    }

    public function removeScreening(Screening $screening): self
    {
        if ($this->Screening->contains($screening)) {
            $this->Screening->removeElement($screening);
            // set the owning side to null (unless already changed)
            if ($screening->getMovie() === $this) {
                $screening->setMovie(null);
            }
        }

        return $this;
    }
}
