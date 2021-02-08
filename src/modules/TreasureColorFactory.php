<?php

declare( strict_types = 1 );
namespace WarioLand3;

class TreasureColorFactory
{
    public static function getTreasureColorByNumber( int $number ) : TreasureColor
    {
        if ( empty( self::$treasureColors ) )
        {
            self::generateTreasureColors();
        }
        return self::$treasureColors[ $number - 1 ];
    }

    private static function generateTreasureColors() : void
    {
        self::$treasureColors = [];
        $i = 1;
        foreach ( self::TREASURE_COLOR_DATA as $name )
        {
            self::$treasureColors[] = new TreasureColor( $i, $name );
            ++$i;
        }
    }

    private static array $treasureColors = [];

    private const TREASURE_COLOR_DATA =
    [
        'Gray',
        'Red',
        'Green',
        'Blue'
    ];
}