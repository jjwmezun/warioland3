<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Enemy
{
    public function __construct
    (
        private int $id,
        private string $name,
        private string $slug,
        private int $order,
        private string $japaneseName,
        private string $japaneseNameRomaji,
        private string $japaneseNameTranslation,
        private string $whatItIs,
        private string $whatItDoes,
        private string $whatYouCanDo,
        private string $grabability,
        private string $respawn,
        private ?bool $sleepsAtNight
    ) {}

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getPluralName() : string
    {
        return $this->name . 's';
    }

    public function getSlug() : string
    {
        return $this->slug;
    }

    public function getWhatItIs() : string
    {
        return $this->whatItIs;
    }

    public function getLevels() : array
    {
        $list = array_map
        (
            fn( array $data ) => LevelFactory::getLevelById( $data[ "enemy_level_level_id" ] ),
            Connection::selectAllWhere( 'enemy_level', [ ParameterBinding::createIntBinding( 'enemy_level_enemy_id', $this->id ) ] )
        );
        usort( $list, fn( Level $a, Level $b ) => ( $a->getOrder() === $b->getOrder() ) ? 0 : ( ( $a->getOrder() < $b->getOrder() ) ? -1 : 1 ) );
        return $list;
    }
}