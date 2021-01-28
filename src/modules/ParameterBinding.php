<?php

declare( strict_types = 1 );
namespace WarioLand3;

class ParameterBinding
{
    static public function createBindingOfType( string $type, string|int $name, $value )
    {
        return new ParameterBinding( $name, $value, self::generateType( $type ) );
    }

    static public function createIntBinding( string|int $name, int $value )
    {
        return new ParameterBinding( $name, $value, \PDO::PARAM_INT );
    }

    static public function createStringBinding( string|int $name, string $value )
    {
        return new ParameterBinding( $name, $value, \PDO::PARAM_STR );
    }

    public function bindToStatement( \PDOStatement $statement ) : void
    {
        $statement->bindParam( $this->name, $this->value, $this->type );
    }

    private static function generateType( string $type ) : int
    {
        switch ( $type )
        {
            case ( "string" ) : return \PDO::PARAM_STR;
            case ( "int" ) : return \PDO::PARAM_INT;
            case ( "integer" ) : return \PDO::PARAM_INT;
        }
        throw new \Exception( "Invalid type for parameter binding: $type" );
    }

    private function __construct
    (
        private string|int $name,
        private $value,
        private int $type
    ) {}
}