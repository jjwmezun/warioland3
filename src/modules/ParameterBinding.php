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



    //
    //  PRIVATE
    //
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    private static function generateType( string $type ) : int
    {
        if ( !array_key_exists( $type, self::TYPES ) )
        {
            throw new \Exception( "Invalid type for parameter binding: $type" );
        }
        return self::TYPES[ $type ];
    }

    private function __construct
    (
        private string|int $name,
        private $value,
        private int $type
    ) {}

    private const TYPES =
    [
        "string" => \PDO::PARAM_STR,
        "int" => \PDO::PARAM_INT,
        "integer" => \PDO::PARAM_INT
    ];
}