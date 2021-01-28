<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Region
{
    public function __construct
    (
        private int $id,
        private string $name,
        private string $code
    ) {}

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getCode() : string
    {
        return $this->code;
    }

    public function getLevels() : array
    {
        return LevelFactory::getLevelsByRegion( $this );
    }
}