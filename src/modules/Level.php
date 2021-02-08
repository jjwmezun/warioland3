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
        private Region $region
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
}