<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Template
{
    public static function generate( string $page, array $attributes = [] ) : string
    {
        $attributes[ 'header' ] =
        [
            'navigation' => HeaderNavigation::getList()
        ];
        return self::$twig->render
        (
            "{$page}.html.twig",
            $attributes
        );
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