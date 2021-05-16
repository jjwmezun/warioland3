<?php

declare( strict_types = 1 );
namespace WarioLand3;

class PageNavigationFactory
{
    static public function getNavigationByPage( Page $page ) : array
    {
        $data = Connection::selectWhere( 'page_navigation', [ ParameterBinding::createIntBinding( 'page_id', $page->getId() ) ] );
        return array_map( fn( array $item ) => new Link( $item[ 'page_navigation_url' ], $item[ 'page_navigation_title' ] ), $data );
    }
}