<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Connection
{
    static public function selectOne( string $table, string $condition_type, string $condition_value ) : array
    {
        $statement = self::$pdo->prepare( 'select distinct * from ' . $table . ' where ' . $condition_type . ' = :value' );
        $statement->bindParam( ':value', $condition_value, \PDO::PARAM_STR );
        $statement->execute();
        $rows = $statement->fetchAll();
        return ( count( $rows ) === 0 ) ? [] : $rows[ 0 ];
    }

    static public function init() : void
    {
        $credentials = self::getCredentials();
        self::$pdo = new \PDO( 'pgsql:host=' . $credentials[ 'host' ] . ';dbname=' . $credentials[ 'dbname' ], $credentials[ 'user' ], $credentials[ 'password' ] );
    }

    static private function getCredentials() : array
    {
        $filename = Config::getServerRoot() . '/.env';
        $handle = fopen( $filename, 'r' );
        if ( !$handle )
        {
            throw new \Exception( 'Missing database credentials.' );
        }
        $fileContents = fread( $handle, filesize( $filename ) );
        if ( !$handle )
        {
            throw new \Exception( 'Could not read database credentials.' );
        }
        $credentials = [];
        $rows = explode( "\n", $fileContents );
        foreach ( $rows as $row )
        {
            $columns = explode( '=', $row );
            if ( count( $columns ) !== 2 )
            {
                throw new \Exception( 'Database credentials malformed.' );
            }
            $credentials[ $columns[ 0 ] ] = $columns[ 1 ];
        }
        return $credentials;
    }

    static private ?\PDO $pdo;
}