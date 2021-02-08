<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Enemy
{
    public function __construct
    (
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
        private ?bool $sleepsAtNight,
        private array $levels
    ) {}

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
        return $this->levels;
    }
}