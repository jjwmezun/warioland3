<?php

declare( strict_types = 1 );
namespace WarioLand3;

class TreasureColor
{
    public function __construct
    (
        private int $number,
        private string $name
    ) {}

    public function getNumber() : int
    {
        return $this->number;
    }

    public function getName() : string
    {
        return $this->name;
    }
}