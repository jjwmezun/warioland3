<?php

declare( strict_types = 1 );
namespace WarioLand3;

class Connection
{
    static public function insertToTable( string $table, array $data ) : string
    {
        $bindings = [];
        $values = array_values( $data );
        for ( $i = 0; $i < count( $values ); ++$i )
        {
            $bindings[] = ParameterBinding::createBindingOfType( gettype( $values[ $i ] ), $i + 1, $values[ $i ] );
        }
        self::fetchAll( "insert into $table (" . implode( ",", array_keys( $data ) ) . ") values (" . implode( ",", array_map( fn() => "?", array_values( $data ) ) ) . ")", $bindings );
        return self::$pdo->lastInsertId();
    }

    static public function clearTable( string $table ) : void
    {
        var_dump( self::fetchAll( "delete from $table" ) );
    }


    static public function selectAll( string $table ) : array
    {
        return self::fetchAll( "select * from $table" );
    }

    static public function selectAllWhere( string $table, array $conditions ) : array
    {
        return self::selectWhere( $table, $conditions, false, "selectAllWhere" );
    }

    static public function selectAllOrderedBy( string $table, array $order ) : array
    {
        if ( empty( $order ) )
        {
            throw new \Exception( "Error calling Connection::selectAllOrderedBy with table $table \$order can’t be left empty" );
        }
        return self::fetchAll( "select * from $table order by " . implode( ", ", $order ) );
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

    static public function init() : void
    {
        $credentials = self::getCredentials();
        self::$pdo = new \PDO( 'pgsql:host=' . $credentials[ 'host' ] . ';dbname=' . $credentials[ 'dbname' ], $credentials[ 'user' ], $credentials[ 'password' ] );
    }



    
    //
    //  PRIVATE
    //
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    static private function selectWhere( string $table, array $conditions, bool $distinct, string $methodName ) : array
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

    static private ?\PDO $pdo;
}