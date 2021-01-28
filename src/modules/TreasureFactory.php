<?php

declare( strict_types = 1 );
namespace WarioLand3;

class TreasureFactory
{
    public static function getAllTreasures() : array
    {
        return array_map( [ self::class, 'getTreasureFromData' ], Connection::selectAllOrderedBy( "treasure", [ "treasure_game_order" ] ) );
    }

    private static function getTreasureFromData( array $data ) : Treasure
    {
        return new Treasure
        (
            $data[ 'treasure_id' ],
            $data[ 'treasure_name' ],
            $data[ 'treasure_slug' ],
            $data[ 'treasure_level_id' ],
            $data[ 'treasure_color_id' ],
            $data[ 'treasure_purpose' ],
            $data[ 'treasure_game_order' ],
            $data[ 'treasure_sequence_order' ]
        );
    }

    /*
    public static function resetTreasureTable() : void
    {
        //Connection::clearTable( "treasure" );
        foreach ( self::TREASURES as $treasure )
        {
            $level = LevelFactory::getLevelByCode( $treasure[ 'level' ] );
            $color = TreasureColorFactory::getTreasureColorByOrder( $treasure[ 'color' ] );
            $data =
            [
                "treasure_name" => $treasure[ 'name' ],
                "treasure_slug" => Utilities::slugify( $treasure[ 'name' ] ),
                "treasure_level_id" => $level->getId(),
                "treasure_color_id" => $color->getId(),
                "treasure_purpose" => $treasure[ 'purpose' ],
                "treasure_game_order" => $treasure[ 'game_order' ],
                "treasure_sequence_order" => $treasure[ 'sequence_order' ]
            ];
            Connection::insertToTable( 'treasure', $data );
        }
        echo "Treasures reset.";
    }*/

    private const TREASURES =
    [
        [ 'name' => '1st Music Box', 'level' => 's1', 'color' => 1, 'purpose' => 'Opens level [level s2].', 'game_order' => 1, 'sequence_order' => 10 ]
    ];
}