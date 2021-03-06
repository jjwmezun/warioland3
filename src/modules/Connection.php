<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Connection
{
    static public function insertToTable( string $table, array $data ) : string
    {
        $bindings = self::generateBindings( $data );
        self::fetchAll( "insert into $table (" . implode( ",", array_keys( $data ) ) . ") values (" . implode( ",", array_map( fn() => "?", array_values( $data ) ) ) . ")", $bindings );
        return self::$pdo->lastInsertId();
    }

    static public function clearTable( string $table ) : void
    {
        self::fetchAll( "delete from $table" );
    }

    static public function updateWhere( string $table, array $changes, array $conditions ) : void
    {
        $bindings = self::generateBindings( $changes );
        $changeStatement = implode( ", ", array_map( fn( $key ) => "$key = ?", array_keys( $changes ) ) );
        $bindingsCount = count( $bindings );
        $conditionsValues = array_values( $conditions );
        $conditionsCount = count( $conditionsValues );
        $j = 0;
        for ( $i = $bindingsCount; $i < $bindingsCount + $conditionsCount; ++$i )
        {
            $bindings[] = ParameterBinding::createBindingOfType( gettype( $conditionsValues[ $j ] ), $i + 1, $conditionsValues[ $j ] );
            ++$j;
        }
        $conditionsStatement = implode( " and ", array_map( fn( $key ) => "$key = ?", array_keys( $conditions ) ) );
        $statement = "update $table set $changeStatement where $conditionsStatement;";
        self::fetchAll( $statement, $bindings );
    }

    static public function selectOne( string $table, array $conditions ) : array
    {
        $rows = self::selectWhere( $table, $conditions, true, "selectOne" );
        return ( count( $rows ) === 0 ) ? [] : $rows[ 0 ];
    }

    static public function searchPagesForQuery( string $table, array $columns, string $query ) : array
    {
        if ( empty( $columns ) )
        {
            throw new \Exception( "Error calling Connection::searchPagesForQuery with table $table & query $query: \$columns can’t be left empty" );
        }
        return self::fetchAll
        (
            "select * from $table where " . implode( " or ", array_map( fn( string $column ) => "lower($column) like :query", $columns ) ),
            [ ParameterBinding::createStringBinding( 'query', "%$query%" ) ]
        );
    }

    static public function selectWhere( string $table, array $conditions, bool $distinct = false, string $methodName = "selectWhere" ) : array
    {
        if ( empty( $conditions ) )
        {
            throw new \Exception( "Error calling Connection::$methodName with table $table \$conditions can’t be left empty" );
        }
        return self::fetchAll
        (
            "select" . ( ( $distinct ) ? " distinct" : "" ) . " * from $table where " . implode( " and ", array_map( fn( ParameterBinding $condition ) => $condition->getName() . " = :" . $condition->getName(), $conditions ) ),
            $conditions
        );
    }

    static public function init() : void
    {
        $credentials = self::getCredentials();
        self::$pdo = new \PDO( 'pgsql:host=' . $credentials[ 'host' ] . ';dbname=' . $credentials[ 'dbname' ], $credentials[ 'user' ], $credentials[ 'password' ] );
    }



    
    //
    //  PRIVATE
    //
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    static private function fetchAll( string $prepare, array $bindings = [] ) : array
    {
        $statement = self::$pdo->prepare( $prepare );
        foreach ( $bindings as $binding )
        {
            $binding->bindToStatement( $statement );
        }
        $statement->execute();
        return $statement->fetchAll();
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

    static private function generateBindings( array $data ) : array
    {
        $bindings = [];
        $values = array_values( $data );
        for ( $i = 0; $i < count( $values ); ++$i )
        {
            $bindings[] = ParameterBinding::createBindingOfType( gettype( $values[ $i ] ), $i + 1, $values[ $i ] );
        }
        return $bindings;
    }

    static private ?\PDO $pdo;
}