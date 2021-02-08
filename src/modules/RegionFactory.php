<?php

declare( strict_types = 1 );
namespace WarioLand3;

class RegionFactory
{
    public static function getAllRegions() : array
    {
        if ( empty( self::$regions ) )
        {
            self::generateRegions();
        }
        return self::$regions;
    }

    public static function getRegionByCode( string $code ) : Region
    {
        if ( empty( self::$regionsByCode ) )
        {
            self::generateRegions();
        }
        return self::$regionsByCode[ $code ];
    }

    private static function generateRegions() : void
    {
        self::$regions = [];
        self::$regionsByCode = [];
        $i = 0;
        foreach ( self::REGION_DATA as $data )
        {
            $region = new Region( $data[ 'name' ], $data[ 'code' ], $i );
            self::$regions[] = $region;
            self::$regionsByCode[ $region->getCode() ] = $region;
            ++$i;
        }
    }

    private static array $regions = [];
    private static array $regionsByCode = [];

    private const REGION_DATA =
    [
        [ 'name' => 'North', 'code' => 'N' ],
        [ 'name' => 'West', 'code' => 'W' ],
        [ 'name' => 'South', 'code' => 'S' ],
        [ 'name' => 'East', 'code' => 'E' ]
    ];
}