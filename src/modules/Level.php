<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Level
{
    public function __construct
    (
        private string $name,
        private string $slug,
        private int $number,
        private string $description,
        private Region $region,
        private string $analysis,
        private string $japaneseName,
        private string $japaneseNameRomaji,
        private string $unlocked,
        private bool $hasMinigolf,
        private int $difficultyScore,
        private int $qualityScore
    ) {}

    public function getName() : string
    {
        return $this->name;
    }

    public function getCode() : string
    {
        return $this->getRegion()->getCode() . $this->number;
    }

    public function getFullName() : string
    {
        return self::getCode() . ' ' . $this->name;
    }

    public function getSlug() : string
    {
        return $this->slug;
    }

    public function getNumber() : int
    {
        return $this->number;
    }

    public function getOrder() : int
    {
        return ( $this->getRegion()->getOrder() - 1 ) * 6 + $this->number;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getRegion() : Region
    {
        return $this->region;
    }

    public function getAnalysis() : string
    {
        return $this->analysis;
    }

    public function getJapaneseName() : string
    {
        return $this->japaneseName;
    }

    public function getJapaneseNameRomaji() : string
    {
        return $this->japaneseNameRomaji;
    }

    public function getUnlocked() : string
    {
        return $this->unlocked;
    }

    public function getHasMinigolf() : bool
    {
        return $this->hasMinigolf;
    }

    public function getDifficultyScore() : int
    {
        return $this->difficultyScore;
    }

    public function getQualityScore() : int
    {
        return $this->qualityScore;
    }
}