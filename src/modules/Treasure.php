<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Treasure
{
    public function getId() : int
    {
        return $this->id;
    }

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
        if ( gettype( $this->level ) === "integer" )
        {
            $this->level = LevelFactory::getLevelById( $this->level );
        }
        return $this->level;
    }

    public function getColor() : TreasureColor
    {
        if ( gettype( $this->color ) === "integer" )
        {
            $this->color = TreasureColorFactory::getTreasureColorById( $this->color );
        }
        return $this->color;
    }

    public function getPurpose() : string
    {
        return $this->purpose;
    }

    public function __construct
    (
        private int $id,
        private string $name,
        private string $slug,
        private Level|int $level,
        private TreasureColor|int $color,
        private string $purpose,
        private int $gameOrder,
        private int $sequenceOrder
    ) {}
}