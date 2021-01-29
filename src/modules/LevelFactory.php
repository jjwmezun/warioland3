<?php

declare( strict_types = 1 );
namespace WarioLand3;

class LevelFactory
{
    public static function getLevelBySlug( string $slug ) : ?Level
    {
        $data = Connection::selectOne( 'level', [ ParameterBinding::createStringBinding( 'level_slug', $slug ) ] );
        return ( !empty( $data ) ) ? new Level( $data[ "level_id" ], $data[ "level_name" ], $data[ "level_slug" ], $data[ "level_order" ], $data[ "level_description" ], $data[ 'level_region_id' ] ) : null;
    }

    public static function getLevelById( int $id ) : ?Level
    {
        $data = Connection::selectOne( 'level', [ ParameterBinding::createIntBinding( 'level_id', $id ) ] );
        return ( !empty( $data ) ) ? new Level( $data[ "level_id" ], $data[ "level_name" ], $data[ "level_slug" ], $data[ "level_order" ], $data[ "level_description" ], $data[ 'level_region_id' ] ) : null;
    }

    public static function getLevelByCode( string $code ) : ?Level
    {
        $regionCode = substr( $code, 0, 1 );
        $numberCode = intval( substr( $code, 1, 1 ) );
        $region = RegionFactory::getRegionByCode( $regionCode );
        $data = Connection::selectOne
        (
            'level',
            [
                ParameterBinding::createIntBinding( 'level_region_id', $region->getId() ),
                ParameterBinding::createIntBinding( 'level_order', $numberCode )
            ]
        );
        return ( !empty( $data ) ) ? new Level( $data[ "level_id" ], $data[ "level_name" ], $data[ "level_slug" ], $data[ "level_order" ], $data[ "level_description" ], $region ) : null;
    }

    public static function getLevelsByRegion( Region $region ) : array
    {
        return array_map
        (
            fn( array $data ) => new Level( $data[ "level_id" ], $data[ "level_name" ], $data[ "level_slug" ], $data[ "level_order" ], $data[ "level_description" ], $region ),
            Connection::selectAllWhereOrderedBy( "level", [ ParameterBinding::createIntBinding( "level_region_id", $region->getId() ) ], [ 'level_order' ] )
        );
    }

    private const LEVELS =
    [
        [ 'region' => 'N', 'order' => 1, 'name' => 'Out of the Woods', 'desc' => '<p>“Out of the Woods” is the 1st &, naturally, easiest level. Most o’ it is a bright, small forest littered with easy-to-dodge [enemy spearheads] & [enemy webbers], with a li’l cave, a li’l lake, & a tall tree area for later treasures.</p>' ],
        [ 'region' => 'N', 'order' => 2, 'name' => 'The Peaceful Village' ],
        [ 'region' => 'N', 'order' => 3, 'name' => 'The Vast Plain' ],
        [ 'region' => 'N', 'order' => 4, 'name' => 'Bank of the Wild River' ],
        [ 'region' => 'N', 'order' => 5, 'name' => 'The Tidal Coast' ],
        [ 'region' => 'N', 'order' => 6, 'name' => 'Sea Turtle Rock' ],
        [ 'region' => 'W', 'order' => 1, 'name' => 'Desert Ruins' ],
        [ 'region' => 'W', 'order' => 2, 'name' => 'The Volcano’s Base' ],
        [ 'region' => 'W', 'order' => 3, 'name' => 'The Pool of Rain' ],
        [ 'region' => 'W', 'order' => 4, 'name' => 'A Town in Chaos' ],
        [ 'region' => 'W', 'order' => 5, 'name' => 'Beneath the Waves' ],
        [ 'region' => 'W', 'order' => 6, 'name' => 'The West Crater' ],
        [ 'region' => 'S', 'order' => 1, 'name' => 'The Grasslands' ],
        [ 'region' => 'S', 'order' => 2, 'name' => 'The Big Bridge' ],
        [ 'region' => 'S', 'order' => 3, 'name' => 'Tower of Revival' ],
        [ 'region' => 'S', 'order' => 4, 'name' => 'The Steep Canyon' ],
        [ 'region' => 'S', 'order' => 5, 'name' => 'Cave of Flames' ],
        [ 'region' => 'S', 'order' => 6, 'name' => 'Above the Clouds' ],
        [ 'region' => 'E', 'order' => 1, 'name' => 'The Stagnant Swamp' ],
        [ 'region' => 'E', 'order' => 2, 'name' => 'The Frigid Sea' ],
        [ 'region' => 'E', 'order' => 3, 'name' => 'Castle of Illusion' ],
        [ 'region' => 'E', 'order' => 4, 'name' => 'The Colossal Hole' ],
        [ 'region' => 'E', 'order' => 5, 'name' => 'The Warped Void' ],
        [ 'region' => 'E', 'order' => 6, 'name' => 'The East Crater' ],
        [ 'region' => 'E', 'order' => 7, 'name' => 'Forest of Fear' ]
    ];
}