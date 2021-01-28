<?php

declare( strict_types = 1 );
namespace WarioLand3;

class RegionFactory
{
    public static function getAllRegions() : array
    {
        return array_map( [ self::class, 'getRegionFromData' ], Connection::selectAllOrderedBy( "region", [ "region_order" ] ) );
    }

    public static function getRegionByCode( string $code ) : ?Region
    {
        $data = Connection::selectOne( 'region', 'region_code', $code );
        return ( !empty( $data ) ) ? self::getRegionFromData( $data ) : null;
    }

    public static function getRegionById( int $id ) : ?Region
    {
        $data = Connection::selectOne( 'region', 'region_id', $id );
        return ( !empty( $data ) ) ? self::getRegionFromData( $data ) : null;
    }

    private static function getRegionFromData( array $data ) : Region
    {
        return new Region( $data[ "region_id" ], $data[ "region_name" ], $data[ "region_code" ], $data[ "region_order" ] );
    }

    private static array $regionsLoaded = [];
}