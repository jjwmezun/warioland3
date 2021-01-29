<?php

declare( strict_types = 1 );
namespace WarioLand3;

class PathFactory
{
    public static function getLevel( Level $level ) : string
    {
        return self::getLevelPath( $level );
    }

    public static function getLevelPath( Level $level ) : string
    {
        return '/level/' . $level->getSlug() . '/';
    }

    public static function getEnemyPath( Enemy $enemy ) : string
    {
        return '/enemies/#' . $enemy->getSlug();
    }
}