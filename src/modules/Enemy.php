<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Enemy
{
    public function __construct
    (
        private string $name,
        private string $fullName,
        private string $pluralName,
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

    public function getFullName() : string
    {
        return $this->fullName;
    }

    public function getPluralName() : string
    {
        return $this->pluralName;
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