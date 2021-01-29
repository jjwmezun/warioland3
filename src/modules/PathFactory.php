<?php

declare( strict_types = 1 );
namespace WarioLand3;

class PathFactory
{
    public static function getLevelPath( Level $level ) : string
    {
        return '/level/' . $level->getSlug() . '/';
    }
}