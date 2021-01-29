<?php

declare( strict_types = 1 );
namespace WarioLand3;

class HeaderNavigation
{
    public static function getList() : array
    {
        return array_map
        (
            function( array $item )
            {
                if ( self::isRawLink( $item ) )
                {
                    return new Link( '/' . $item[ 'url' ], $item[ 'title' ] );
                }
                else if ( self::isPageLink( $item ) )
                {
                    $page = PageFactory::getPageBySlug( $item[ 'slug' ] );
                    if ( !$page )
                    {
                        throw new \Exception( "Missing page with slug: " . $item[ 'slug' ] );
                    }
                    $title = $item[ 'title' ] ?? $page->getTitle(); // O’erride title if manually set.
                    return new Link( '/' . $item[ 'slug' ] . '/', $title );
                }
                throw new \Exception( "Header navigation has invalid item" );
            },
            self::DATA
        );
    }

    private static function isRawLink( array $item ) : bool
    {
        return array_key_exists( 'url', $item ) && array_key_exists( 'title', $item );
    }

    private static function isPageLink( array $item ) : bool
    {
        return array_key_exists( 'slug', $item );
    }

    private const DATA =
    [
        [ 'url' => '', 'title' => 'About' ],
        [ 'url' => 'enemies', 'title' => 'Enemies' ],
        [ 'url' => 'levels', 'title' => 'Levels' ],
        [ 'url' => 'treasures', 'title' => 'Treasures' ],
        [ 'slug' => 'minigolf' ]
    ];
}