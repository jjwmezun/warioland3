<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Page
{
    public function __construct
    (
        private int $id,
        private string $title,
        private string $content,
        private ?array $navigation = null
    ) {}

    public function getId() : int
    {
        return $this->id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function hasList() : bool
    {
        if ( $this->navigation === null )
        {
            $this->navigation = PageNavigationFactory::getNavigationByPage( $this );
        }
        return !empty( $this->navigation );
    }

    public function getList() : array
    {
        if ( $this->navigation === null )
        {
            $this->navigation = PageNavigationFactory::getNavigationByPage( $this );
        }
        return $this->navigation;
    }
}