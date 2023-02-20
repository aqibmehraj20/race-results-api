<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="race")
 */
class Race
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $mediumAvgTime;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $longAvgTime;

    // Getters and Setters for all the fields
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getMediumAvgTime(): ?\DateTimeInterface
    {
        return $this->mediumAvgTime;
    }

    public function setMediumAvgTime(?\DateTimeInterface $mediumAvgTime): self
    {
        $this->mediumAvgTime = $mediumAvgTime;

        return $this;
    }

    public function getLongAvgTime(): ?\DateTimeInterface
    {
        return $this->longAvgTime;
    }

    public function setLongAvgTime(?\DateTimeInterface $longAvgTime): self
    {
        $this->longAvgTime = $longAvgTime;

        return $this;
    }
}
