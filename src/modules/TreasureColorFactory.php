<?php

declare( strict_types = 1 );
namespace WarioLand3;

class TreasureColorFactory
{
    public static function getTreasureColorById( int $id ) : ?TreasureColor
    {
        return self::getTreasureColorByBindings( [ ParameterBinding::createIntBinding( 'treasure_color_id', $id ) ] );
    }

    public static function getTreasureColorByOrder( int $order ) : ?TreasureColor
    {
        return self::getTreasureColorByBindings( [ ParameterBinding::createIntBinding( 'treasure_color_order', $order ) ] );
    }

    private static function getTreasureColorByBindings( array $bindings ) : ?TreasureColor
    {
        $data = Connection::selectOne( 'treasure_color', $bindings );
        return ( !empty( $data ) ) ? new TreasureColor( $data[ 'treasure_color_id' ], $data[ 'treasure_color_name' ], $data[ 'treasure_color_order' ] ): null;
    }
}