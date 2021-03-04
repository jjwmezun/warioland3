<?php

declare( strict_types = 1 );
namespace WarioLand3;

class LevelFactory
{
    public static function getAllLevels() : array
    {
        if ( empty( self::$levels ) )
        {
            self::generateLevels();
        }
        return self::$levels;
    }

    public static function getLevelBySlug( string $slug ) : Level
    {
        if ( empty( self::$levelsBySlug ) )
        {
            self::generateLevels();
        }
        return self::$levelsBySlug[ $slug ];
    }

    public static function getLevelByCode( string $code ) : Level
    {
        if ( empty( self::$levelsByCode ) )
        {
            self::generateLevels();
        }
        return self::$levelsByCode[ strtolower( $code ) ];
    }

    public static function getLevelsByRegion( Region $region ) : array
    {
        if ( empty( self::$levelsByRegion ) )
        {
            self::generateLevels();
        }
        return self::$levelsByRegion[ $region->getCode() ];
    }

    private static function generateLevels() : void
    {
        self::$levels = [];
        self::$levelsBySlug = [];
        self::$levelsByRegion = [];
        foreach ( RegionFactory::getAllRegions() as $region )
        {
            self::$levelsByRegion[ $region->getCode() ] = [];
        }
        foreach ( self::LEVEL_DATA as $data )
        {
            $level = new Level
            (
                $data[ 'name' ],
                Utilities::slugify( $data[ 'name' ] ),
                $data[ 'number' ],
                $data[ 'desc' ] ?? '',
                RegionFactory::getRegionByCode( $data[ 'region' ] ),
                $data[ 'analysis' ] ?? '',
                $data[ 'jpName' ] ?? '',
                $data[ 'jpNameRomaji' ] ?? '',
                $data[ 'unlocked' ] ?? '',
                $data[ 'minigolf' ] ?? false,
                $data[ 'difficulty' ] ?? 1,
                $data[ 'quality' ] ?? 1,
            );
            self::$levels[] = $level;
            self::$levels[ $level->getSlug() ] = $level;
            self::$levelsByRegion[ $level->getRegion()->getCode() ][] = $level;
            self::$levelsByCode[ strtolower( $level->getRegion()->getCode() ) . $level->getNumber() ] = $level;
        }
    }

    private static array $levels = [];
    private static array $levelsBySlug = [];
    private static array $levelsByRegion = [];
    private static array $levelsByCode = [];

    private const LEVEL_DATA =
    [
        [
            'region' => 'N',
            'number' => 1,
            'name' => 'Out of the Woods',
            'desc' => '<p>“Out of the Woods” is the 1st &, naturally, easiest level. Most o’ it is a bright, small forest littered with easy-to-dodge [enemy spearhead true] & [enemy webber true], with a li’l cave, a li’l lake, & a tall tree area for later treasures.</p>',
            'analysis' => '<p>For a 1st level, “Out of the Woods” could’ve been much weaker than it turned out. Yes, starting your game in a green forest is 1 o’ the most cliché things you could do, specially compared to <i>Wario Land II</i> starting you out in Wario’s castle full o’ walls to break for coins. But while that level & its game had a mo’ interesting setting, “Out of the Woods”, as well as <i>Wario Land 3</i> in general, has a much mo’ interesting level layout.</p>',
            'jpName' => '出発の森',
            'jpNameRomaji' => 'Shuppatsu no Mori',
            'unlocked' => '<p>Being the 1st level o’ the game, this is the only level not unlocked thru a treasure: The Temple you start the game @ leads directly to it.</p>',
            'minigolf' => true,
            'difficulty' => 2,
            'quality' => 3
        ],
        [ 'region' => 'N', 'number' => 2, 'name' => 'The Peaceful Village' ],
        [ 'region' => 'N', 'number' => 3, 'name' => 'The Vast Plain' ],
        [ 'region' => 'N', 'number' => 4, 'name' => 'Bank of the Wild River' ],
        [ 'region' => 'N', 'number' => 5, 'name' => 'The Tidal Coast' ],
        [ 'region' => 'N', 'number' => 6, 'name' => 'Sea Turtle Rock' ],
        [ 'region' => 'W', 'number' => 1, 'name' => 'Desert Ruins' ],
        [ 'region' => 'W', 'number' => 2, 'name' => 'The Volcano’s Base' ],
        [ 'region' => 'W', 'number' => 3, 'name' => 'The Pool of Rain' ],
        [ 'region' => 'W', 'number' => 4, 'name' => 'A Town in Chaos' ],
        [ 'region' => 'W', 'number' => 5, 'name' => 'Beneath the Waves' ],
        [ 'region' => 'W', 'number' => 6, 'name' => 'The West Crater' ],
        [ 'region' => 'S', 'number' => 1, 'name' => 'The Grasslands' ],
        [ 'region' => 'S', 'number' => 2, 'name' => 'The Big Bridge' ],
        [ 'region' => 'S', 'number' => 3, 'name' => 'Tower of Revival' ],
        [ 'region' => 'S', 'number' => 4, 'name' => 'The Steep Canyon' ],
        [ 'region' => 'S', 'number' => 5, 'name' => 'Cave of Flames' ],
        [ 'region' => 'S', 'number' => 6, 'name' => 'Above the Clouds' ],
        [ 'region' => 'E', 'number' => 1, 'name' => 'The Stagnant Swamp' ],
        [ 'region' => 'E', 'number' => 2, 'name' => 'The Frigid Sea' ],
        [ 'region' => 'E', 'number' => 3, 'name' => 'Castle of Illusion' ],
        [ 'region' => 'E', 'number' => 4, 'name' => 'The Colossal Hole' ],
        [ 'region' => 'E', 'number' => 5, 'name' => 'The Warped Void' ],
        [ 'region' => 'E', 'number' => 6, 'name' => 'The East Crater' ],
        [ 'region' => 'E', 'number' => 7, 'name' => 'Forest of Fear' ]
    ];
}