<?php

declare( strict_types = 1 );
namespace WarioLand3;

class ParameterBinding
{
    static public function createStringBinding( string $name, string $value )
    {
        return new ParameterBinding( $name, $value, \PDO::PARAM_STR );
    }

    public function bindToStatement( \PDOStatement $statement ) : void
    {
        $statement->bindParam( $this->name, $this->value, $this->type );
    }

    private function __construct
    (
        private string $name,
        private $value,
        private int $type
    ) {}
}