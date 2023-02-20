<?php
// src/Entity/Result.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="result")
 */
class Result
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
    private $fullName;

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance($distance): void
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time): void
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getAgeCategory()
    {
        return $this->ageCategory;
    }

    /**
     * @param mixed $ageCategory
     */
    public function setAgeCategory($ageCategory): void
    {
        $this->ageCategory = $ageCategory;
    }

    /**
     * @return mixed
     */
    public function getOverallPlacement()
    {
        return $this->overallPlacement;
    }

    /**
     * @param mixed $overallPlacement
     */
    public function setOverallPlacement($overallPlacement): void
    {
        $this->overallPlacement = $overallPlacement;
    }

    /**
     * @return mixed
     */
    public function getAgeCategoryPlacement()
    {
        return $this->ageCategoryPlacement;
    }

    /**
     * @param mixed $ageCategoryPlacement
     */
    public function setAgeCategoryPlacement($ageCategoryPlacement): void
    {
        $this->ageCategoryPlacement = $ageCategoryPlacement;
    }

    /**
     * @return mixed
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param mixed $race
     */
    public function setRace($race): void
    {
        $this->race = $race;
    }

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $distance;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ageCategory;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $overallPlacement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ageCategoryPlacement;

    /**
     * @ORM\ManyToOne(targetEntity="Race", inversedBy="results")
     * @ORM\JoinColumn(nullable=false)
     */
    private $race;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }



}


