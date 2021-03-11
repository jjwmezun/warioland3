<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Treasure
{
    public function __construct
    (
        private string $name,
        private string $slug,
        private Level $level,
        private TreasureColor $color,
        private string $purpose,
        private int $gameOrder,
        private int $sequenceOrder
    ) {}

    public function getName() : string
    {
        return $this->name;
    }

    public function getSlug() : string
    {
        return $this->slug;
    }

    public function getLevel() : Level
    {
        return $this->level;
    }

    public function getColor() : TreasureColor
    {
        return $this->color;
    }

    public function getPurpose() : string
    {
        return $this->purpose;
    }

    public function getGameOrder() : int
    {
        return $this->gameOrder;
    }

    public function getSequenceOrder() : int
    {
        return $this->sequenceOrder;
    }
}