<?php

declare( strict_types = 1 );
namespace WarioLand3;

class HeaderNavigation
{
    public static function getList() : array
    {
        return array_filter
        (
            array_map
            (
                function( array $item )
                {
                    if ( array_key_exists( 'url', $item ) && array_key_exists( 'title', $item ) )
                    {
                        return new Link( $item[ 'url' ], $item[ 'title' ] );
                    }
                    else if ( array_key_exists( 'slug', $item ) )
                    {
                        $page = PageFactory::getPageBySlug( $item[ 'slug' ] );
                        if ( !$page )
                        {
                            throw new \Exception( "Missing page with slug: " . $item[ 'slug' ] );
                        }
                        return new Link( $item[ 'slug' ] . '/', $item[ 'title' ] ?? $page->getTitle() );
                    }
                    throw new \Exception( "Header navigation has invalid item" );
                },
                self::DATA
            )
        );
    }

    private const DATA =
    [
        [ 'url' => '/', 'title' => 'About' ],
        [ 'slug' => 'minigolf' ]
    ];
}