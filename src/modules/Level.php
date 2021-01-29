<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Level
{
    public function __construct
    (
        private int $id,
        private string $name,
        private string $slug,
        private int $number,
        private ?string $description,
        private Region|int $region
    ) {}

    public function getId() : int
    {
        return $this->id;
    }

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

    public function getOrder() : int
    {
        return ( $this->getRegion()->getOrder() - 1 ) * 6 + $this->number;
    }

    public function getDescription() : ?string
    {
        return $this->description;
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