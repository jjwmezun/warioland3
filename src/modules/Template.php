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
        $attributes[ 'path' ] = new PathFactory();
        return self::doShortcodes
        (
            self::$twig->render
            (
                "{$page}.html.twig",
                $attributes
            )
        );
    }

    public static function init() : void
    {
        $loader = new \Twig\Loader\FilesystemLoader( dirname( __DIR__ ) . '/templates' );
        self::$twig = new \Twig\Environment
        (
            $loader
        );
        self::$shortcodes =
        [
            'level' => function( array $args ) : string|bool
            {
                if ( count( $args ) !== 1 )
                {
                    return false;
                }
                $level = LevelFactory::getLevelByCode( $args[ 0 ] );
                return ( $level ) ? '<a href="' . PathFactory::getLevelPath( $level ) . '">“' . $level->getFullName() . '”</a>' : false;
            },
            'enemy' => function( array $args ) : string|bool
            {
                $count = count( $args );
                $plural = false;
                if ( $count !== 1 && $count !== 2 )
                {
                    return false;
                }
                if ( $count === 2 )
                {
                    $plural = boolval( $args[ 1 ] );
                }
                $enemy = EnemyFactory::getEnemyBySlug( $args[ 0 ] );
                return ( $enemy ) ? '<a href="' . PathFactory::getEnemyPath( $enemy ) . '">' . ( ( $plural ) ? $enemy->getPluralName() : $enemy->getName() ) . '</a>' : false;
            }
        ];
    }

    private static function doShortcodes( string $text ) : string
    {
        $currentIndex = -1;
        while ( $currentIndex = strpos( $text, '[', $currentIndex + 1 ) )
        {
            $start = $currentIndex;
            $body = '';
            $currentIndex++; // Skip opening bracket.
            while ( $c = substr( $text, $currentIndex, 1 ) )
            {
                if ( $c === ']' )
                {
                    $endingFound = true;
                    $args = explode( ' ', $body );
                    if ( array_key_exists( $args[ 0 ], self::$shortcodes ) )
                    {
                        $replacement = self::$shortcodes[ $args[ 0 ] ]( array_slice( $args, 1 ) );
                        if ( $replacement !== false )
                        {
                            $text = str_replace( '[' . $body . ']', $replacement, $text );
                            $currentIndex = $start;
                        }
                    }
                    break;
                }
                $body .= $c;
                $currentIndex++;
            }
        }
        return $text;
    }

    private static ?\Twig\Environment $twig = null;
    private static array $shortcodes;
}