<?php

declare( strict_types = 1 );
namespace WarioLand3;

class PageFactory
{
    static public function getPageBySlug( string $slug ) : ?Page
    {
        $data = Connection::selectOne( 'page', [ ParameterBinding::createStringBinding( 'page_slug', $slug ) ] );
        return ( !empty( $data ) ) ? self::createPageFromData( $data ) : null;
    }

    static public function getPagesBySearchQuery( string $query ) : array
    {
        return array_map
        (
            fn( array $item ) => self::createPageFromData( $item ),
            $data = Connection::searchPagesForQuery( 'page', [ 'page_title', 'page_content' ], $query )
        );
    }

    static private function createPageFromData( array $data ) : Page
    {
        return new Page( $data[ 'page_id' ], $data[ 'page_title' ], $data[ 'page_content' ] );
    }
}