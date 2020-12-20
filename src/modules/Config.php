<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Config
{
    static public function getServerRoot() : string
    {
        return dirname( dirname( __DIR__ ) );
    }
}