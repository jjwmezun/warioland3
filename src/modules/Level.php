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
        private Region|int $region
    ) {}

    public function getName() : string
    {
        return $this->name;
    }

    public function getFullName() : string
    {
        return $this->getRegion()->getCode() . $this->number . ' ' . $this->name;
    }

    public function getSlug() : string
    {
        return $this->slug;
    }

    public function getNumber() : int
    {
        return $this->number;
    }

    public function getRegion() : Region
    {
        if ( gettype( $this->region ) === 'integer' )
        {
            $this->region = RegionFactory::getRegionById( $this->region );
        }
        return $this->region;
    }
}