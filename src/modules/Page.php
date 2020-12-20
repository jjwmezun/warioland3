<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Page
{
    static public function getPageBySlug( string $slug ) : ?Page
    {
        $data = Connection::selectOne( 'page', 'page_slug', $slug );
        if ( !empty( $data ) )
        {
            return new Page( $data[ 'page_title' ], $data[ 'page_content' ] );
        }
        throw new \Exception( 'Invalid page' );
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function __construct
    (
        private string $title,
        private string $content
    ) {}
}