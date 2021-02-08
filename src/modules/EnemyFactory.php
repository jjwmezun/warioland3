<?php

declare( strict_types = 1 );
namespace WarioLand3;

class EnemyFactory
{
    public static function getAllEnemies() : array
    {
        if ( empty( self::$enemies ) )
        {
            self::generateEnemies();
        }
        return self::$enemies;
    }

    public static function getEnemyBySlug( string $slug ) : Enemy
    {
        if ( empty( self::$enemiesBySlug ) )
        {
            self::generateEnemies();
        }
        return self::$enemiesBySlug[ $slug ];
    }

    private static function generateEnemies() : void
    {
        self::$enemies = [];
        self::$enemiesBySlug = [];
        $i = 1;
        foreach ( self::ENEMY_DATA as $data )
        {
            $enemy = new Enemy
            (
                $data[ 'enemy_name' ],
                Utilities::slugify( $data[ 'enemy_name' ] ),
                $i,
                $data[ 'enemy_name_jp' ],
                $data[ 'enemy_name_jp_romaji' ],
                $data[ 'enemy_name_jp_translation' ],
                $data[ 'enemy_what_it_is' ],
                $data[ 'enemy_what_it_does' ],
                $data[ 'enemy_what_you_can_do' ],
                $data[ 'enemy_grabability' ],
                $data[ 'enemy_respawn' ],
                $data[ 'enemy_sleeps_at_night' ],
                array_map( fn( string $code ) => LevelFactory::getLevelByCode( $code ), $data[ 'levels' ] )
            );
            self::$enemies[] = $enemy;
            self::$enemiesBySlug[ $enemy->getSlug() ] = $enemy;
            ++$i;
        }
    }

    private static array $enemies = [];
    private static array $enemiesBySlug = [];

    private const ENEMY_DATA =
    [
        [
            'enemy_name' => 'Spearhead',
            'enemy_name_jp' => 'ヤリマル',
            'enemy_name_jp_romaji' => 'Yarimaru',
            'enemy_name_jp_translation' => 'Spear Circle',
            'enemy_what_it_is' => '<p>The most common & basic enemy.</p><p>Baby blue sphere with a spade-shaped spear protruding from its face like a nose & inverted black & white eyes connected o’er the bridge.</p>',
            'enemy_what_it_does' => '',
            'enemy_what_you_can_do' => '',
            'enemy_grabability' => 'small',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => true,
            'levels' => [ 'N1', 'N2', 'N3', 'N4', 'N6', 'W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'S1', 'S2', 'S3', 'S4', 'S5', 'E1', 'E2', 'E3', 'E4' ]
        ],
        [
            'enemy_name' => 'Webber',
            'enemy_name_jp' => 'ヤリマル',
            'enemy_name_jp_romaji' => 'Yarimaru',
            'enemy_name_jp_translation' => 'Spear Circle',
            'enemy_what_it_is' => '<p>The most common & basic enemy.</p><p>Baby blue sphere with a spade-shaped spear protruding from its face like a nose & inverted black & white eyes connected o’er the bridge.</p>',
            'enemy_what_it_does' => '',
            'enemy_what_you_can_do' => '',
            'enemy_grabability' => 'small',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => true,
            'levels' => [ 'N1', 'N2', 'N3', 'N4', 'N6', 'W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'S1', 'S2', 'S3', 'S4', 'S5', 'E1', 'E2', 'E3', 'E4' ]
        ]
    ];
}