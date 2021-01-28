<?php

declare( strict_types = 1 );
namespace WarioLand3;

class TreasureColor
{
    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function __construct
    (
        private int $id,
        private string $name,
        private int $order
    ) {}
}