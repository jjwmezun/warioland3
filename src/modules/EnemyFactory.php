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
                $data[ 'enemy_fullname' ] ?? $data[ 'enemy_name' ],
                $data[ 'enemy_name_plural' ] ?? $data[ 'enemy_name' ] . 's',
                $data[ 'enemy_slug' ] ?? Utilities::slugify( $data[ 'enemy_name' ] ),
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
        ],
        [
            'enemy_name' => 'Blue Bird',
            'enemy_slug' => 'blue-bird',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Silky',
            'enemy_name_plural' => 'Silkies',
            'enemy_name_jp' => 'いも虫',
            'enemy_name_jp_romaji' => 'Imomushi',
            'enemy_name_jp_translation' => 'Caterpillar',
            'enemy_what_it_is' => '<p>A green caterpillar.</p>',
            'enemy_what_it_does' => '<p>Squirm left & right ’long ledges & can turn you into Ball O’ String Wario if you touch their face while their mouth is open.</p>',
            'enemy_what_you_can_do' => '<p>Ground pounding or charge attacking it can destroy it, & bumping it will stun it.</p>',
            'enemy_grabability' => 'small',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => [ 'N1', 'N3', 'W1', 'W4', 'W5', 'W6', 'S1', 'S3' ]
        ],
        [
            'enemy_name' => 'Para-Goom',
            'enemy_name_jp' => 'カサマル',
            'enemy_name_jp_romaji' => 'Kasamaru',
            'enemy_name_jp_translation' => 'Para-head',
            'enemy_what_it_is' => '<p>A yellow chestnut-shaped creature holding a silver parasol.</p>',
            'enemy_what_it_does' => '<p>Walks left & right ’long ledges holding a parasol that stuns you if you touch it. After a few steps, it stops & moves its parasol from in front o’ it to ’bove it & vice-versa.</p>',
            'enemy_what_you_can_do' => '<p>You can destroy it by charge attacking it from ’hind, or in front o’ it if its parasol is up, or ground pounding it while its parasol is in front o’ it. Bumping it from a side not guarded by a parasol or jumping on it stuns is.</p>',
            'enemy_grabability' => 'small',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => [ 'N2', 'N3', 'N6', 'W1', 'W2', 'W3', 'W4', 'W5', 'S3', 'S4', 'S5', 'E1', 'E2', 'E3', 'E5', 'E6' ]
        ],
        [
            'enemy_name' => 'Doughnuteer',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Zombie',
            'enemy_name_jp' => 'ゾンビ',
            'enemy_name_jp_romaji' => 'Zonbi',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p>A teal-skinned zombie with sharp, melty fangs, orange-lit eyes, & tearing black shirt & orange pants.</p>',
            'enemy_what_it_does' => '<p>Sluggishly shifts its feet side to side & throws his face when it sees Wario. Touching its face will turn Wario into a zombie himself.</p><p>Sometimes they’ll rise from the ground & fall back into it alternately.</p>',
            'enemy_what_you_can_do' => '<p>Ducking under its head as it throws them will avoid touching them.</p><p>If you’re a zombie, touching them will destroy them. Otherwise, you’ll only bump into them & maybe become zombified if touching their face.</p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => [ 'N2', 'N3', 'W4', 'S3', 'S6', 'E3', 'E7' ]
        ],
        [
            'enemy_name' => 'Spear-bot',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Hammer-bot',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Teruteru',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Mad Scienstein',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Eye Wall',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Sand Hand',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Count Richtertoffen',
            'enemy_fullname' => 'Count Richtertoffen the II',
            'enemy_slug' => 'richtertoffen',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Beam-bot',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Brrr Bear',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Mole-Hole Cover',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Grab-bot',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Sir Smashalot',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Roofy',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Pink Bird',
            'enemy_slug' => 'pink-bird',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Pufferflounder',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Pneumo ( Jellybob )',
            'enemy_slug' => 'pneumo',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Burn-bot',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => '',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Snake in the Pot',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Waterhertz',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'River Reacher',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Prince Froggy',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Bat Bites',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Robo-Mouse',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Appleby',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Bark Bug',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Sr. Sun',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Mr. Moon',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Octopinch',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Octopush',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Tadpounce',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Prickly Platform',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Beam-Reach',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ],
        [
            'enemy_name' => 'Fish & Spitz',
            'enemy_name_jp' => '',
            'enemy_name_jp_romaji' => '',
            'enemy_name_jp_translation' => 'Zombie',
            'enemy_what_it_is' => '<p></p>',
            'enemy_what_it_does' => '<p></p>',
            'enemy_what_you_can_do' => '<p></p>',
            'enemy_grabability' => 'none',
            'enemy_respawn' => 'change room',
            'enemy_sleeps_at_night' => false,
            'levels' => []
        ]
    ];
}