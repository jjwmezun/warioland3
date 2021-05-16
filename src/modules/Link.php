<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Link
{
    public function getUrl() : string
    {
        return $this->url;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getSlug() : string
    {
        return $this->slug;
    }

    public function __construct
    (
        private string $url,
        private string $title,
        private string $slug = ''
    ) {}
}