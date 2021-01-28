<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Utilities
{
    public static function slugify( string $text ) : string
    {
        return strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/', '', preg_replace( '/[\s\t\r_]+/', '-', $text ) ), '-' ) );
    }
}