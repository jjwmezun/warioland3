<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Region
{
    public function __construct
    (
        private string $name,
        private string $code,
        private int $order
    ) {}

    public function getName() : string
    {
        return $this->name;
    }

    public function getCode() : string
    {
        return $this->code;
    }

    public function getOrder() : int
    {
        return $this->order;
    }

    public function getLevels() : array
    {
        return LevelFactory::getLevelsByRegion( $this );
    }
}