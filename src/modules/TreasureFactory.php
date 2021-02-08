<?php

declare( strict_types = 1 );
namespace WarioLand3;

class TreasureFactory
{
    public static function getAllTreasures() : array
    {
        if ( empty( self::$treasures ) )
        {
            self::generateTreasures();
        }
        return self::$treasures;
    }

    private static function generateTreasures() : void
    {
        self::$treasures = [];
        foreach ( self::TREASURE_DATA as $data )
        {
            self::$treasures[] = new Treasure
            (
                $data[ 'name' ],
                Utilities::slugify( $data[ 'name' ] ),
                LevelFactory::getLevelByCode( $data[ 'level' ] ),
                TreasureColorFactory::getTreasureColorByNumber( $data[ 'color' ] ),
                $data[ 'purpose' ],
                $data[ 'game_order' ],
                $data[ 'sequence_order' ]
            );
        }
    }

    private static array $treasures = [];

    private const TREASURE_DATA =
    [
        [ 'name' => '1st Music Box', 'level' => 's1', 'color' => 1, 'purpose' => 'Opens level [level s2].', 'game_order' => 1, 'sequence_order' => 10 ]
    ];
}