<?php

declare( strict_types = 1 );
namespace WarioLand3;

class TreasureFactory
{
    public static function getAllTreasures() : array
    {
        if ( empty( self::$treasures ) )
        {
            self::generateTreasures();
        }
        return self::$treasures;
    }

    public static function getTreasureByLevelAndColor( Level $level, TreasureColor $color ) : Treasure
    {
        if ( empty( self::$treasures ) )
        {
            self::generateTreasures();
        }
        return self::$treasureLevelMap[ strtolower( $level->getCode() ) . $color->getNumber() ];
    }

    public static function getTreasureBySlug( string $slug ) : Treasure
    {
        if ( empty( self::$treasures ) )
        {
            self::generateTreasures();
        }
        return self::$treasureSlugMap[ $slug ];
    }

    public static function getTreasureBySequenceOrder( int $sequenceOrder ) : Treasure
    {
        if ( empty( self::$treasures ) )
        {
            self::generateTreasures();
        }
        return self::$treasuresSequenceOrder[ $sequenceOrder ];
    }

    private static function generateTreasures() : void
    {
        self::$treasures = [];
        for ( $i = 0; $i < count( self::TREASURE_DATA ); ++$i )
        {
            self::$treasuresSequenceOrder[] = null;
        }
        foreach ( self::TREASURE_DATA as $data )
        {
            $slug = Utilities::slugify( $data[ 'name' ] );
            $treasure = new Treasure
            (
                $data[ 'name' ],
                $slug,
                LevelFactory::getLevelByCode( $data[ 'level' ] ),
                TreasureColorFactory::getTreasureColorByNumber( $data[ 'color' ] ),
                $data[ 'purpose' ],
                $data[ 'game_order' ],
                $data[ 'sequence_order' ]
            );
            self::$treasures[] = $treasure;
            self::$treasureLevelMap[ strtolower( $data[ 'level' ] ) . $data[ 'color' ] ] = $treasure;
            self::$treasureSlugMap[ $slug ] = $treasure;
            self::$treasuresSequenceOrder[ $treasure->getSequenceOrder() - 1 ] = $treasure;
        }
    }

    private static array $treasures = [];
    private static array $treasuresSequenceOrder = [];
    private static array $treasureLevelMap = [];
    private static array $treasureSlugMap = [];

    private const TREASURE_DATA =
    [
        [
            'name' => '1st Music Box',
            'level' => 's1',
            'color' => 1,
            'purpose' => 'Opens level [level s2].',
            'game_order' => 1,
            'sequence_order' => 10
        ],
        [
            'name' => '2nd Music Box',
            'level' => 'w4',
            'color' => 2,
            'purpose' => 'Opens levels [level n4] & [level n5].',
            'game_order' => 2,
            'sequence_order' => 20
        ],
        [
            'name' => '3rd Music Box',
            'level' => 'n6',
            'color' => 1,
            'purpose' => 'Opens level [level s5].',
            'game_order' => 3,
            'sequence_order' => 31
        ],
        [
            'name' => '4th Music Box',
            'level' => 'e1',
            'color' => 3,
            'purpose' => 'Opens level [level w5].',
            'game_order' => 4,
            'sequence_order' => 39
        ],
        [
            'name' => '5th Music Box',
            'level' => 'n1',
            'color' => 4,
            'purpose' => 'Unlocks the finale @ [level temple]',
            'game_order' => 5,
            'sequence_order' => 48
        ],
        [
            'name' => 'Super Flippers',
            'level' => 'n1',
            'color' => 3,
            'purpose' => 'Gives Wario the ability to swim extra fast by pressing the B button, allowing him to swim past currents.',
            'game_order' => 6,
            'sequence_order' => 43
        ],
        [
            'name' => 'Flippers',
            'level' => 's3',
            'color' => 1,
            'purpose' => 'Allows Wario to swim under the surface o’ water.',
            'game_order' => 7,
            'sequence_order' => 14
        ],
        [
            'name' => 'Winged Boot',
            'level' => 'e4',
            'color' => 3,
            'purpose' => 'Allows Wario to jump higher by holding Up, & e’en higher by jumping off enemies.',
            'game_order' => 8,
            'sequence_order' => 38
        ],
        [
            'name' => 'Brown Glove',
            'level' => 'e6',
            'color' => 1,
            'purpose' => 'Allows Wario to pick up & throw large enemies.',
            'game_order' => 9,
            'sequence_order' => 46
        ],
        [
            'name' => 'Garlic',
            'level' => 's3',
            'color' => 2,
            'purpose' => 'Allows Wario to break solid blocks & kill large enemies with his charge attack.',
            'game_order' => 10,
            'sequence_order' => 30
        ],
        [
            'name' => 'Red Glove',
            'level' => 's4',
            'color' => 1,
            'purpose' => 'Allows Wario to pick up & throw small enemies.',
            'game_order' => 11,
            'sequence_order' => 23
        ],
        [
            'name' => 'Blue Overalls',
            'level' => 'w2',
            'color' => 1,
            'purpose' => 'Allows Wario to ground pound.',
            'game_order' => 12,
            'sequence_order' => 6
        ],
        [
            'name' => 'Red Overalls',
            'level' => 'e3',
            'color' => 1,
            'purpose' => 'Allows Wario to break solid blocks & kill large enemies with his ground pound.',
            'game_order' => 13,
            'sequence_order' => 35
        ],
        [
            'name' => 'Spike Helmet',
            'level' => 'e2',
            'color' => 1,
            'purpose' => 'Allows Wario to break cracked & solid blocks by jumping under them.',
            'game_order' => 14,
            'sequence_order' => 19
        ],
        [
            'name' => 'Lantern',
            'level' => 's2',
            'color' => 4,
            'purpose' => 'Opens level [level e3].',
            'game_order' => 15,
            'sequence_order' => 33
        ],
        [
            'name' => 'Lantern Fire',
            'level' => 'e2',
            'color' => 3,
            'purpose' => 'Opens level [level e3].',
            'game_order' => 16,
            'sequence_order' => 34
        ],
        [
            'name' => 'Torch',
            'level' => 'e3',
            'color' => 2,
            'purpose' => 'Opens level [level e7] & opens passage ’tween North & East.',
            'game_order' => 17,
            'sequence_order' => 65
        ],
        [
            'name' => 'Screw',
            'level' => 'w3',
            'color' => 1,
            'purpose' => 'Opens level [level s1].',
            'game_order' => 18,
            'sequence_order' => 8
        ],
        [
            'name' => 'Cog',
            'level' => 'w4',
            'color' => 1,
            'purpose' => 'Opens level [level s1].',
            'game_order' => 19,
            'sequence_order' => 9
        ],
        [
            'name' => 'Pocket Mirror',
            'level' => 'e7',
            'color' => 1,
            'purpose' => 'Opens level [level e5].',
            'game_order' => 20,
            'sequence_order' => 66
        ],
        [
            'name' => 'Rain Jar',
            'level' => 'n1',
            'color' => 2,
            'purpose' => 'Opens levels [level w3] & [level w4] by creating a cloud that rains o’er a dirt divet.',
            'game_order' => 21,
            'sequence_order' => 7
        ],
        [
            'name' => 'Map',
            'level' => 's3',
            'color' => 3,
            'purpose' => 'Opens level [level e6] by showing him where it is.',
            'game_order' => 22,
            'sequence_order' => 45
        ],
        [
            'name' => 'Ice Spellbook',
            'level' => 'n2',
            'color' => 2,
            'purpose' => 'Combined with [treasure-icon ice-wand] opens level [level e2] by freezing solid a lake.',
            'game_order' => 23,
            'sequence_order' => 17
        ],
        [
            'name' => 'Key',
            'level' => 's3',
            'color' => 4,
            'purpose' => 'Opens level [level s6] by unlocking a door @ the top o’ [level s5].',
            'game_order' => 24,
            'sequence_order' => 84
        ],
        [
            'name' => 'Lightning Spellbook',
            'level' => 'n5',
            'color' => 1,
            'purpose' => 'Combined with [treasure-icon lightning-wand] opens level [level s4] by creating lightning, which strikes some rocky area.',
            'game_order' => 25,
            'sequence_order' => 22
        ],
        [
            'name' => 'Lightning Wand',
            'level' => 'n4',
            'color' => 1,
            'purpose' => 'Combined with [treasure-icon lightning-spellbook] opens level [level s4] by creating lightning, which strikes some rocky area.',
            'game_order' => 26,
            'sequence_order' => 21
        ],
        [
            'name' => 'Axe',
            'level' => 'n1',
            'color' => 1,
            'purpose' => 'Opens levels [level n2] & [level n3] by chopping down a tree.',
            'game_order' => 27,
            'sequence_order' => 1
        ],
        [
            'name' => 'Ice Wand',
            'level' => 's1',
            'color' => 3,
            'purpose' => 'Combined with [treasure-icon ice-spellbook] opens level [level e2] by freezing solid a lake.',
            'game_order' => 28,
            'sequence_order' => 18
        ],
        [
            'name' => 'Blue Skull',
            'level' => 'w3',
            'color' => 2,
            'purpose' => 'Combined with [treasure-icon red-skull] opens level [level s3] by making it rise from underground.',
            'game_order' => 29,
            'sequence_order' => 13
        ],
        [
            'name' => 'Red Skull',
            'level' => 'n3',
            'color' => 3,
            'purpose' => 'Combined with [treasure-icon blue-skull] opens level [level s3] by making it rise from underground.',
            'game_order' => 30,
            'sequence_order' => 12
        ],
        [
            'name' => 'Blue Tablet Half',
            'level' => 'n2',
            'color' => 1,
            'purpose' => 'Combined with [treasure-icon green-tablet-half] pens level [level w1] by unlocking the door in the hill ’tween North & West.',
            'game_order' => 31,
            'sequence_order' => 2
        ],
        [
            'name' => 'Green Tablet Half',
            'level' => 'n3',
            'color' => 1,
            'purpose' => 'Combined with [treasure-icon blue-tablet-half] pens level [level w1] by unlocking the door in the hill ’tween North & West.',
            'game_order' => 32,
            'sequence_order' => 3
        ],
        [
            'name' => 'Paper Fan',
            'level' => 'w3',
            'color' => 3,
            'purpose' => 'Opens level [level e1] by blowing ’way mist that’s in the way.',
            'game_order' => 33,
            'sequence_order' => 15
        ],
        [
            'name' => 'Top Half o’ Scroll',
            'level' => 'w1',
            'color' => 1,
            'purpose' => 'Combined with [treasure-icon bottom-half-o-scroll] opens level [level w2] by, um, making a tornado disappear. Yeah, I don’t get it, either.',
            'game_order' => 34,
            'sequence_order' => 4
        ],
        [
            'name' => 'Bottom Half o’ Scroll',
            'level' => 'w1',
            'color' => 2,
            'purpose' => 'Combined with [treasure-icon top-half-o-scroll] opens level [level w2] by, um, making a tornado disappear. Yeah, I don’t get it, either.',
            'game_order' => 35,
            'sequence_order' => 5
        ],
        [
            'name' => 'Leaf',
            'level' => 'w2',
            'color' => 4,
            'purpose' => 'Combined with [treasure-icon conch] & [treasure-icon pinecone] opens levels [level w6] & [level e4] by causing volcano eruptions, which blasts big holes in the west side o’ the volcano & a big hole in the middle o’ the East.',
            'game_order' => 36,
            'sequence_order' => 25
        ],
        [
            'name' => 'Conch',
            'level' => 's4',
            'color' => 2,
            'purpose' => 'Combined with [treasure-icon leaf] & [treasure-icon pinecone] opens levels [level w6] & [level e4] by causing volcano eruptions, which blasts big holes in the west side o’ the volcano & a big hole in the middle o’ the East.',
            'game_order' => 37,
            'sequence_order' => 26
        ],
        [
            'name' => 'Pinecone',
            'level' => 'e1',
            'color' => 2,
            'purpose' => 'Combined with [treasure-icon leaf] & [treasure-icon conch] opens levels [level w6] & [level e4] by causing volcano eruptions, which blasts big holes in the west side o’ the volcano & a big hole in the middle o’ the East.',
            'game_order' => 38,
            'sequence_order' => 27
        ],
        [
            'name' => 'Blue Chemicals',
            'level' => 's4',
            'color' => 4,
            'purpose' => 'Combined with [treasure-icon red-chemicals] moves the 5-ton blocks in [level n3] & [level w5] by spilling chemicals on the ground under them, opening access to the blue chest ’hind each o’ them.',
            'game_order' => 39,
            'sequence_order' => 92
        ],
        [
            'name' => 'Red Chemicals',
            'level' => 'w5',
            'color' => 3,
            'purpose' => 'Combined with [treasure-icon blue-chemicals] moves the 5-ton blocks in [level n3] & [level w5] by spilling chemicals on the ground under them, opening access to the blue chest ’hind each o’ them.',
            'game_order' => 40,
            'sequence_order' => 91
        ],
        [
            'name' => 'Pump',
            'level' => 'e4',
            'color' => 2,
            'purpose' => 'Makes the underwater glass cylinder in [level n4] & [level w3] rise up to the surface, opening access to the blue chest for each o’ them.',
            'game_order' => 41,
            'sequence_order' => 59
        ],
        [
            'name' => 'Fruit',
            'level' => 'w4',
            'color' => 4,
            'purpose' => 'Grows the octopuses in [level n5] & [level w5], opening access to the blue chest for the former & the green chest for the latter.',
            'game_order' => 42,
            'sequence_order' => 79
        ],
        [
            'name' => 'Infrared Goggles',
            'level' => 'e6',
            'color' => 3,
            'purpose' => 'Brightens the dark red room in [level n6], opening access to its blue chest.',
            'game_order' => 43,
            'sequence_order' => 97
        ],
        [
            'name' => 'Mechanical Fan',
            'level' => 'n5',
            'color' => 3,
            'purpose' => 'Allows the wind to be turned on in [level w4] while the switch is turned on, opening access to its blue chest.',
            'game_order' => 44,
            'sequence_order' => 78
        ],
        [
            'name' => 'Rust Spray',
            'level' => 'e3',
            'color' => 4,
            'purpose' => 'Rusts the metal walls in [level w6], [level s4], & [level s5], opening access to the blue chest in each o’ them.',
            'game_order' => 45,
            'sequence_order' => 89
        ],
        [
            'name' => 'Little Knitter',
            'level' => 'n4',
            'color' => 3,
            'purpose' => 'Knits the rest o’ the climbable chain walls in [level n5] & [level s3], opening access to the green chest in each o’ them.',
            'game_order' => 46,
            'sequence_order' => 44
        ],
        [
            'name' => 'Detonator',
            'level' => 'w5',
            'color' => 1,
            'purpose' => 'Blows up the bombs attached to wooden logs in [level s5], [level e1], & [level e4], opening access to the green chest in [level s5], & the blue chest in [level e1] & [level e4].',
            'game_order' => 47,
            'sequence_order' => 40
        ],
        [
            'name' => 'Scissors',
            'level' => 's5',
            'color' => 4,
            'purpose' => 'Cuts the string o’ the balloon @ the beginning o’ [level s6], opening access to its green chest.',
            'game_order' => 48,
            'sequence_order' => 95
        ],
        [
            'name' => 'Box',
            'level' => 'w6',
            'color' => 3,
            'purpose' => 'Fills the gaps in the green & blue chest rooms o’ [level e3], opening access to its blue treasure.',
            'game_order' => 49,
            'sequence_order' => 88
        ],
        [
            'name' => 'Remote Control',
            'level' => 'e7',
            'color' => 3,
            'purpose' => 'Causes the yellow warp balls in [level e5] to disappear, opening access to its red & green treasures.',
            'game_order' => 50,
            'sequence_order' => 68
        ],
        [
            'name' => 'Red Card Key',
            'level' => 'e7',
            'color' => 4,
            'purpose' => 'Opens the box holding the [enemy para-goom] in [level e5], opening access to its blue treasure.',
            'game_order' => 51,
            'sequence_order' => 71
        ],
        [
            'name' => 'Blue Card Key',
            'level' => 'e7',
            'color' => 2,
            'purpose' => 'Drills dirt blocking streams in [level e6], opening access to its green treasure.',
            'game_order' => 52,
            'sequence_order' => 72
        ],
        [
            'name' => 'Drill',
            'level' => 's6',
            'color' => 3,
            'purpose' => 'Drills dirt blocking streams in [level e6], opening access to its green treasure.',
            'game_order' => 53,
            'sequence_order' => 96
        ],
        [
            'name' => 'Pickaxe',
            'level' => 's6',
            'color' => 4,
            'purpose' => 'Picks warp hole in wall in [level e6], opening access to its blue treasure.',
            'game_order' => 54,
            'sequence_order' => 99
        ],
        [
            'name' => 'Toy Rocket',
            'level' => 'n4',
            'color' => 4,
            'purpose' => 'None.',
            'game_order' => 55,
            'sequence_order' => 60
        ],
        [
            'name' => 'Pokémon Pikachu',
            'level' => 's2',
            'color' => 3,
            'purpose' => 'None.',
            'game_order' => 56,
            'sequence_order' => 57
        ],
        [
            'name' => 'Valve',
            'level' => 'e5',
            'color' => 1,
            'purpose' => 'Raises warp pipe in [level e7], opening access to its red & green treasures.',
            'game_order' => 57,
            'sequence_order' => 67
        ],
        [
            'name' => 'Blood',
            'level' => 'e5',
            'color' => 3,
            'purpose' => 'Makes [enemy zombie true] appear in graveyard area o’ [level e7], opening access to its blue treasure.',
            'game_order' => 58,
            'sequence_order' => 70
        ],
        [
            'name' => 'Sand',
            'level' => 'e3',
            'color' => 3,
            'purpose' => 'Blown into the big tree in [level n1], opening access inside o’ the tree, where the blue treasure lies.',
            'game_order' => 59,
            'sequence_order' => 47
        ],
        [
            'name' => 'Doll',
            'level' => 's1',
            'color' => 4,
            'purpose' => 'None.',
            'game_order' => 60,
            'sequence_order' => 81
        ],
        [
            'name' => 'Wheels',
            'level' => 's1',
            'color' => 2,
            'purpose' => 'Gives wheels to the little cars in [level w2], allowing them to move, giving Wario access to W2’s red treasure.',
            'game_order' => 61,
            'sequence_order' => 50
        ],
        [
            'name' => 'Flute',
            'level' => 'e1',
            'color' => 1,
            'purpose' => 'Makes the snakes appear in the pots in [level n2], [level w2], & [level s1], opening access to the red & green treasures o’ [level n2] & the green treasures o’ [level w2] & [level s1].',
            'game_order' => 62,
            'sequence_order' => 16
        ],
        [
            'name' => 'Foot Weight',
            'level' => 'n5',
            'color' => 2,
            'purpose' => 'Shakes the earth, breaking open boulder-blocked paths in [level w2] & [level s4] & decreasing the water level o’ [level e1]. This opens access to the blue treasure o’ [level w2] & the red treasures o’ [level s4] & [level e1].',
            'game_order' => 63,
            'sequence_order' => 24
        ],
        [
            'name' => 'Left Golden Snake Eye',
            'level' => 'n6',
            'color' => 2,
            'purpose' => 'Combined with [treasure-icon right-golden-snake-eye] opens the red door o’ [level s3], opening access to the blue treasure.',
            'game_order' => 64,
            'sequence_order' => 82
        ],
        [
            'name' => 'Right Golden Snake Eye',
            'level' => 'w4',
            'color' => 3,
            'purpose' => 'Combined with [treasure-icon left-golden-snake-eye] opens the red door o’ [level s3], opening access to the blue treasure.',
            'game_order' => 65,
            'sequence_order' => 83
        ],
        [
            'name' => 'Left Blue Snake Eye',
            'level' => 'w6',
            'color' => 1,
            'purpose' => 'Combined with [treasure-icon right-blue-snake-eye] opens the blue door o’ [level s3], opening access to the red treasure.',
            'game_order' => 66,
            'sequence_order' => 28
        ],
        [
            'name' => 'Right Blue Snake Eye',
            'level' => 'e4',
            'color' => 1,
            'purpose' => 'Combined with [treasure-icon left-blue-snake-eye] opens the blue door o’ [level s3], opening access to the red treasure.',
            'game_order' => 67,
            'sequence_order' => 29
        ],
        [
            'name' => 'Water Wand',
            'level' => 's5',
            'color' => 1,
            'purpose' => 'Cleans up water in [level n6], [level s2], & [level e2], opening access to the red treasure o’ [level n6], the blue treasure o’ [level s2], & the green treasure o’ [level e2].',
            'game_order' => 68,
            'sequence_order' => 32
        ],
        [
            'name' => 'Left Half o’ Sun Stone',
            'level' => 'n6',
            'color' => 3,
            'purpose' => 'Combined with [treasure-icon right-half-o-sun-stone] makes the sun appear in the East, allowing it to become day there. This makes it possible to get the green treasure o’ [level e4] & is 1 o’ the ways to get the blue chest o’ [level e2].',
            'game_order' => 69,
            'sequence_order' => 36
        ],
        [
            'name' => 'Right Half o’ Sun Stone',
            'level' => 'w1',
            'color' => 4,
            'purpose' => 'Combined with [treasure-icon left-half-o-sun-stone] makes the sun appear in the East, allowing it to become day there. This makes it possible to get the green treasure o’ [level e4] & is 1 o’ the ways to get the blue chest o’ [level e2].',
            'game_order' => 70,
            'sequence_order' => 37
        ],
        [
            'name' => 'Whirlwind',
            'level' => 'e1',
            'color' => 4,
            'purpose' => 'Combined with [treasure-icon sack], makes leaves fall in the lake area o’ [level n1], opening access to its green treasure.',
            'game_order' => 71,
            'sequence_order' => 42
        ],
        [
            'name' => 'Seed',
            'level' => 's2',
            'color' => 1,
            'purpose' => 'Drops seeds in [level n3], [level w3], & [level s1], granting access to the red treasures o’ [level w3] & [level s1] & the green treasure o’ [level n3].',
            'game_order' => 72,
            'sequence_order' => 11
        ],
        [
            'name' => 'Sack',
            'level' => 's5',
            'color' => 3,
            'purpose' => 'Combined with [treasure-icon whirlwind], makes leaves fall in the lake area o’ [level n1], opening access to its green treasure.',
            'game_order' => 73,
            'sequence_order' => 41
        ],
        [
            'name' => 'Gong',
            'level' => 's6',
            'color' => 4,
            'purpose' => 'Makes the moon come out during night in [level s6], opening access to its blue treasure.',
            'game_order' => 74,
            'sequence_order' => 98
        ],
        [
            'name' => 'Telephone',
            'level' => 's4',
            'color' => 3,
            'purpose' => 'None.',
            'game_order' => 75,
            'sequence_order' => 76
        ],
        [
            'name' => 'Crown',
            'level' => 'w2',
            'color' => 3,
            'purpose' => 'None.',
            'game_order' => 76,
            'sequence_order' => 54
        ],
        [
            'name' => 'Day/Night Tablet',
            'level' => 'n2',
            'color' => 4,
            'purpose' => 'Allows you to change ’tween day & night manually on the map screen.',
            'game_order' => 77,
            'sequence_order' => 63
        ],
        [
            'name' => 'Red Bracelet',
            'level' => 'n3',
            'color' => 4,
            'purpose' => 'None.',
            'game_order' => 78,
            'sequence_order' => 93
        ],
        [
            'name' => 'Green Bracelet',
            'level' => 'n5',
            'color' => 4,
            'purpose' => 'None.',
            'game_order' => 79,
            'sequence_order' => 80
        ],
        [
            'name' => 'Blue Bracelet',
            'level' => 'w2',
            'color' => 2,
            'purpose' => 'None.',
            'game_order' => 80,
            'sequence_order' => 51
        ],
        [
            'name' => 'Club',
            'level' => 'w5',
            'color' => 4,
            'purpose' => 'None.',
            'game_order' => 81,
            'sequence_order' => 94
        ],
        [
            'name' => 'Spade',
            'level' => 'w6',
            'color' => 4,
            'purpose' => 'None.',
            'game_order' => 82,
            'sequence_order' => 90
        ],
        [
            'name' => 'Heart',
            'level' => 'e5',
            'color' => 4,
            'purpose' => 'None.',
            'game_order' => 83,
            'sequence_order' => 73
        ],
        [
            'name' => 'Diamond',
            'level' => 'e6',
            'color' => 2,
            'purpose' => 'None.',
            'game_order' => 84,
            'sequence_order' => 87
        ],
        [
            'name' => 'Gloom',
            'level' => 'e6',
            'color' => 4,
            'purpose' => 'None.',
            'game_order' => 85,
            'sequence_order' => 100
        ],
        [
            'name' => 'Saber',
            'level' => 'w6',
            'color' => 2,
            'purpose' => 'None.',
            'game_order' => 86,
            'sequence_order' => 62
        ],
        [
            'name' => 'Chalice',
            'level' => 'n2',
            'color' => 3,
            'purpose' => 'None.',
            'game_order' => 87,
            'sequence_order' => 53
        ],
        [
            'name' => 'Teapot',
            'level' => 'e2',
            'color' => 2,
            'purpose' => 'None.',
            'game_order' => 88,
            'sequence_order' => 56
        ],
        [
            'name' => 'Magnifying Glass',
            'level' => 'n4',
            'color' => 2,
            'purpose' => 'Hold B on the map screen & you’ll be able to see which treasures you’ve gotten on the level tile you’re standing on.',
            'game_order' => 89,
            'sequence_order' => 58
        ],
        [
            'name' => 'UFO',
            'level' => 'e2',
            'color' => 4,
            'purpose' => 'None.',
            'game_order' => 90,
            'sequence_order' => 64
        ],
        [
            'name' => 'Toy Car',
            'level' => 's5',
            'color' => 2,
            'purpose' => 'None.',
            'game_order' => 91,
            'sequence_order' => 74
        ],
        [
            'name' => 'Toy Train',
            'level' => 'e4',
            'color' => 4,
            'purpose' => 'None.',
            'game_order' => 92,
            'sequence_order' => 75
        ],
        [
            'name' => 'Fire Extinguisher',
            'level' => 's6',
            'color' => 2,
            'purpose' => 'Extinguishes the fire in the upper-left area o’ [level w6], opening access to its green treasure.',
            'game_order' => 93,
            'sequence_order' => 86
        ],
        [
            'name' => 'Red Crayon',
            'level' => 'w5',
            'color' => 2,
            'purpose' => 'Colors the door o’ the hill ’tween North & West. Collect all 7 to unlock a minigame.',
            'game_order' => 94,
            'sequence_order' => 77
        ],
        [
            'name' => 'Brown Crayon',
            'level' => 'e5',
            'color' => 2,
            'purpose' => 'Colors the ground & trees o’ the hill ’tween North & West. Collect all 7 to unlock a minigame.',
            'game_order' => 95,
            'sequence_order' => 69
        ],
        [
            'name' => 'Yellow Crayon',
            'level' => 'w3',
            'color' => 4,
            'purpose' => 'Colors the sign o’ the hill ’tween North & West. Collect all 7 to unlock a minigame.',
            'game_order' => 96,
            'sequence_order' => 61
        ],
        [
            'name' => 'Green Crayon',
            'level' => 's6',
            'color' => 1,
            'purpose' => 'Colors the grass & trees o’ the hill ’tween North & West. Collect all 7 to unlock a minigame.',
            'game_order' => 97,
            'sequence_order' => 85
        ],
        [
            'name' => 'Cyan Crayon',
            'level' => 's2',
            'color' => 2,
            'purpose' => 'Colors the sky o’ the hill ’tween North & West. Collect all 7 to unlock a minigame.',
            'game_order' => 98,
            'sequence_order' => 52
        ],
        [
            'name' => 'Blue Crayon',
            'level' => 'n3',
            'color' => 2,
            'purpose' => 'Colors the bushes o’ the hill ’tween North & West. Collect all 7 to unlock a minigame.',
            'game_order' => 99,
            'sequence_order' => 49
        ],
        [
            'name' => 'Pink Crayon',
            'level' => 'w1',
            'color' => 3,
            'purpose' => 'Colors the building o’ the hill ’tween North & West. Collect all 7 to unlock a minigame.',
            'game_order' => 100,
            'sequence_order' => 55
        ]
    ];
}