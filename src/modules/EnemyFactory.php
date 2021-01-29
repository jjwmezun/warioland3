<?php

declare( strict_types = 1 );
namespace WarioLand3;

class EnemyFactory
{
    public static function getAllEnemies() : array
    {
        return array_map
        (
            [ self::class, 'getEnemyFromData' ],
            Connection::selectAllOrderedBy( 'enemy', [ 'enemy_order' ] )
        );
    }

    public static function getEnemyBySlug( string $slug ) : ?Enemy
    {
        $data = Connection::selectOne( 'enemy', [ ParameterBinding::createStringBinding( 'enemy_slug', $slug ) ] );
        return ( !empty( $data ) ) ? self::getEnemyFromData( $data ) : null;
    }

    public static function resetEnemyTable() : void
    {
        Connection::clearTable( 'enemy_level' );
        Connection::clearTable( 'enemy' );
        for ( $i = 0; $i < count( self::ENEMIES ); ++$i )
        {
            $enemy = self::ENEMIES[ $i ];
            $levels = $enemy[ 'levels' ];
            unset( $enemy[ 'levels' ] );
            $enemy[ 'enemy_order' ] = $i + 1;
            $enemy[ 'enemy_slug' ] = Utilities::slugify( $enemy[ 'enemy_name' ] );
            $enemyId = intval( Connection::insertToTable( 'enemy', $enemy ) );
            foreach ( $levels as $levelId )
            {
                $level = LevelFactory::getLevelByCode( $levelId );
                Connection::insertToTable( 'enemy_level', [ 'enemy_level_level_id' => $level->getId(), 'enemy_level_enemy_id' => $enemyId ] );
            }
        }
        echo( 'Enemies reset.' );
    }

    private static function getEnemyFromData( array $data ) : Enemy
    {
        return new Enemy
        (
            $data[ 'enemy_id' ],
            $data[ 'enemy_name' ],
            $data[ 'enemy_slug' ],
            $data[ 'enemy_order' ],
            $data[ 'enemy_name_jp' ],
            $data[ 'enemy_name_jp_romaji' ],
            $data[ 'enemy_name_jp_translation' ],
            $data[ 'enemy_what_it_is' ],
            $data[ 'enemy_what_it_does' ],
            $data[ 'enemy_what_you_can_do' ],
            $data[ 'enemy_grabability' ],
            $data[ 'enemy_respawn' ],
            $data[ 'enemy_sleeps_at_night' ]
        );
    }

    private const ENEMIES =
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
        ]
    ];
}