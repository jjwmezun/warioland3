<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Connection
{
    static public function selectOne( string $table, string $condition_type, string $condition_value ) : array
    {
        $rows = self::fetchAll
        (
            "select distinct * from $table where $condition_type = :value",
            [ ParameterBinding::createStringBinding( ':value', $condition_value ) ]
        );
        return ( count( $rows ) === 0 ) ? [] : $rows[ 0 ];
    }

    static public function searchPagesForQuery( string $table, array $columns, string $query ) : array
    {
        var_dump( $query );
        if ( empty( $columns ) )
        {
            throw new \Exception( "Error calling Connection::searchPagesForQuery with table $table & query $query: \$columns cannot be left empty" );
        }
        return self::fetchAll
        (
            "select * from $table where " . implode( " or ", array_map( fn( string $column ) => "lower($column) like :query", $columns ) ),
            [ ParameterBinding::createStringBinding( ':query', "%$query%" ) ]
        );
    }

    static private function fetchAll( string $prepare, array $bindings ) : array
    {
        $statement = self::$pdo->prepare( $prepare );
        foreach ( $bindings as $binding )
        {
            $binding->bindToStatement( $statement );
        }
        $statement->execute();
        return $statement->fetchAll();
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