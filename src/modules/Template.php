<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Template
{
    public function __construct( string $page, array $attributes = [] )
    {
        $attributes[ 'header' ] =
        [
            'navigation' => HeaderNavigation::getList()
        ];
        $this->content = self::$twig->render
        (
            "{$page}.html.twig",
            $attributes
        );
    }

    public function getHtml() : string
    {
        return $this->content;
    }

    public static function hasBeenInitialized() : bool
    {
        return self::$twig !== null;
    }

    public static function init() : void
    {
        $loader = new \Twig\Loader\FilesystemLoader( dirname( __DIR__ ) . '/templates' );
        self::$twig = new \Twig\Environment
        (
            $loader
        );
    }

    private string $content;
    private static ?\Twig\Environment $twig = null;
}