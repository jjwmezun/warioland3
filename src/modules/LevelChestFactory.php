<?php

declare( strict_types = 1 );
namespace WarioLand3;

class LevelChestFactory
{
    public static function getChestsByLevel( Level $level ) : array
    {
        return array_map
        (
            function ( array $data ) use ( $level )
            {
                $treasureColor = TreasureColorFactory::getTreasureColorByNumber( $data[ 'color' ] );
                return new LevelChest
                (
                    $level,
                    $treasureColor,
                    TreasureFactory::getTreasureByLevelAndColor( $level, $treasureColor ),
                    $data[ 'difficulty' ],
                    $data[ 'quality' ],
                    $data[ 'time' ],
                    $data[ 'dayOrNight' ] ?? 'Either',
                    $data[ 'treasuresNeeded' ] ?? [],
                    $data[ 'walkthru' ] ?? '',
                    $data[ 'analysis' ] ?? ''
                );
            },
            ( self::LEVEL_DATA[ strtolower( $level->getCode() ) ] ?? [] )
        );
    }

    private const LEVEL_DATA =
    [
        'n1' =>
        [
            [
                'color' => 1,
                'difficulty' => 1,
                'quality' => 1,
                'time' => 30,
                'analysis' => '<i>Wario Land 3</i>’s 1st treasure does what any good pseudo-Metroidvania does: it litters its path with tantalizing side paths impossible to reach @ the beginning, which not only propels me mo’ to want to keep playing now so I can find whate’er I need to get o’er there & find out what’s there, but also makes it feel mo’ rewarding when you finally unlock that area, as if you accomplished something that has been itching @ you for a while.</p><p>The other advantage is that this makes the level feel deeper while still being, defacto, a simple straightforward path, thus avoiding the risk o’ putting too much pressure on players while they’re still learning the game. Defacto, getting the gray treasure is nothing mo’ than walking down a straight line thru 2 areas, jumping up platforms in the 1 branch in which you can do anything @ the end o’ the 2nd area to grab the gray key, & then continuing right for 1 mo’ area before entering a door @ the end, where the last room holds the gray chest. Almost all the enemies do nothing but stun you for a few seconds, with the only obstacle close to threatening being the fire-spurting pole @ the end o’ the 3rd area that can waste a lot more o’ your time & likely force you back to the start o’ the area. Howe’er, littered ’long this path are a platform blocked by throw blocks one can immediately confirm they cannot charge attack to break; a platform with a frog or mole under it taunting you that you can’t go down, e’en tho the conspicuous space under it tells you there definitely is something down there; a door to an empty lake with a cliff way too high to reach & water you can’t swim down to pass under the cliff; & right ’bove the door @ the end o’ the 3rd area a cliff too high to reach.2 To rub it in, the game e’en puts a green key in plain sight up there, — it’s less hidden than the gray key you actually need — so you know for a fact you need to go up there some day. If you’re familiar with other Mario games or e’en other Wario Land games you may e’en try to hop off the nearby Spearguy to reach up there only to find it to be hopeless.',
                'walkthru' => '<p>Wario went straight right thru the 1st 2 areas o’ the forest, up the 2 staircases o’ purple blocks & past all the [enemy spearhead true] & [enemy webber true], only to stop @ the end o’ the 2nd area, where he found a suspicious line o’ thin green platforms ’tween 2 trees going straight up. He climbs up these platforms, avoiding the [enemy spearhead true] patrolling them, till he reaches the top, where he finds the gray key.</p><p>He drops back down & continues going right into the next area. After climbing the steeper cliffs covered with purple blocks & going down the slope he continues right, dodging the fire-spitting flame, but runs into a dead end with a door. With nowhere else to go, he enters the door to find himself in a wood-walled room with [enemy silky true] inside. He avoids their knitting mouths as he hops up the wooden platforms, & then climbs up a ladder to find @ the topmost level the gray chest waiting for him to open it.</p>'
            ],
            [
                'color' => 2,
                'difficulty' => 1,
                'quality' => 1,
                'time' => 90,
                'analysis' => '<p>The red treasure is definitely the weakest of “Out of the Woods”. If one chooses this o’ the 2 treasures opened by collecting the o’eralls, this will be the 1st new treasure unlocked in an ol’ level one plays; & since this is the 1st level, full o’ mocking side-paths you couldn’t take, this side path being opened already will be specially interesting. Howe’er, the short-lived excitement o’ finally being able to push down gainst that mole & reach the door below is followed by a treasure that takes place entirely in a short cave, which has li’l to do with this level’s woodland theme & li’l to do with the rest o’ the level @ all to the point that this section could be transplanted to ’nother level & replaced with a different room with a red key & chest & it’d hardly be noticeable. & yet, this cave area also has li’l to set it apart from the rest o’ the game. The most prominent obstacles in this section are cracked blocks & the minigolf game, which you already have to beat for the red treasure in “The Vast Plain”, the other treasure you have to do to proceed. Otherwise you have Grab-bots that don’t do much ’less you’re going for the music coin & Webbers who are less threatening than the ones you dodged in the gray treasure, since they’re in small, packed-in areas with plenty o’ walls so that if they do hit you, you won’t be thrown far back.</p><p>To be fair, there are some subtle touches: the Webber on the tight space holding the red key is a clever way to teach the player to use the ladder to safely bop Webbers from below & it’s cool that the pointless Grab-bot that wastes your time as you step down the platforms @ the beginning o’ this area can be bonked on the head as you go back down from the minigame door for the chest. Speaking o’ which, the circular path you take going from the beginning, where the chest is blocked by a minigame door, & then back after you open it, minimizes retreading area you’ve explored.</p>'
            ],
            [
                'color' => 3,
                'difficulty' => 1,
                'quality' => 1,
                'time' => 120,
                'dayOrNight' => 'Night',
                'analysis' => '<p>The chest room is a straightforward platforming challenge, with falling or being knocked off by an enemy effectively “death”, dropping you into the lake far below whose current pushes you back to the start, the only place where you can start ’gain, since the leaves & cliffs are too high up anywhere else. While it’s nice that the falling leaves are a unique gimmick to this treasure, it feels mo’ arbitrary than most blocked-off paths, where you can wager a guess as to what will unblock that path. On the other hand, since this room was always the most mysterious o’ blocked paths in the 1st level, being so empty, maybe it’s fitting that the solution is so exotic.</p><p>While it’s nice to also get closure on the green key, which the player will likely see way back @ the beginning o’ the game, since it’s way off in a completely different area, there’s no logical connection ’tween the green key & chest, other than the very weak theme o’ jumping off things to reach higher cliffs. Then ’gain, maybe it’s refreshing to have the key & chest so separated when most treasures have them much closer.</p>'
            ],
            [
                'color' => 4,
                'difficulty' => 1,
                'quality' => 1,
                'time' => 210,
                'analysis' => '<p>This treasure has a unique tileset that fits perfectly with this level’s woodland theme, tricky jumps you have to make off enemies which fits this level’s later point in the game, & has 1 o’ the mo’ interesting bosses. & I love that the final music box is found in the final treasure o’ the 1st level.</p><p>The only problem with this treasure is the abysmal blue key, which just requires you to fall off the side o’ the tree round the middle to grab it, & then retrace your steps back up. So it’s just padding & making you do the same thing twice. There are many better places to put this. If they couldn’t find room to create a side area in the tree itself with maybe an extra enemy-hopping puzzle, they could put it in the high treetops in the main areas o’ the level, which only hold music coins, or e’en swap the green key with the blue key, since what you need to do to reach that key is arguably mo’ relevant to the blue treasure than the green treasure.</p>'
            ]
        ]
    ];
}