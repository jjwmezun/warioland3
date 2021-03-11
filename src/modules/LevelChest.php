<?php

declare( strict_types = 1 );
namespace WarioLand3;

class LevelChest
{
    public function __construct
    (
        private Level $level,
        private TreasureColor $treasureColor,
        private Treasure $treasure,
        private int $difficultyRating,
        private int $personalRating,
        private int $averageTime,
        private string $requiresDayOrNight,
        private array $treasuresNeeded,
        private string $walkthru,
        private string $analysis
    ) {}

    public function getLevel() : Level
    {
        return $this->level;
    }

    public function getTreasureColor() : TreasureColor
    {
        return $this->treasureColor;
    }

    public function getTreasure() : Treasure
    {
        return $this->treasure;
    }

    public function getDifficultyRating() : int
    {
        return $this->difficultyRating;
    }

    public function getPersonalRating() : int
    {
        return $this->personalRating;
    }

    public function getAverageTime() : string
    {
        $minutes = floor( $this->averageTime / 60.0 );
        $seconds = $this->averageTime % 60;
        return ( $minutes > 0 )
            ? "$minutes:$seconds minutes"
            : "$seconds seconds";
    }

    public function getRequiresDayOrNight() : string
    {
        return $this->requiresDayOrNight;
    }

    public function getTreasuresNeeded() : array
    {
        return $this->treasuresNeeded;
    }

    public function getWalkthru() : string
    {
        return $this->walkthru;
    }

    public function getAnalysis() : string
    {
        return $this->analysis;
    }
}