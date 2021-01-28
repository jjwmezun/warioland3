<?php

declare( strict_types = 1 );
namespace WarioLand3;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

require_once( '../vendor/autoload.php' );

ini_set( 'display_errors', '1' );
ini_set( 'display_startup_errors', '1' );
error_reporting( E_ALL );

Connection::init();
Template::init();

$request = Request::createFromGlobals();
$path = $request->getPathInfo();

if ( !str_ends_with( $path, '/' ) )
{
    $response = new RedirectResponse( $path . '/' );
    $response->send();
}

if ( str_starts_with( $path, '/' ) )
{
    // Remove 1st character.
    $path = mb_substr( $path, 1 );
}

if ( $path === 'home/' )
{
    $response = new RedirectResponse( '/' );
    $response->send();
}

$content = '';
if ( in_array( $path, [ '', '/' ] ) )
{
    $content = ( new Template( 'page', [ 'page' => PageFactory::getPageBySlug( 'home' ) ] ) )->getHtml();
}
/*
else if ( $path === 'reset/levels/' )
{
    LevelFactory::resetLevelTable();
}
*/
else if ( $path === 'levels/' )
{
    $content = ( new Template( 'levels-archive', [ 'regions' => new RegionFactory() ] ) )->getHtml();
}
else if ( $path === 'search/' )
{
    $query = $request->query->get( 'query' );
    $response = new RedirectResponse( "/search/$query/" );
    $response->send();
}
else if ( str_starts_with( $path, 'search/' ) )
{
    $query = urldecode( str_replace( '/', '', str_replace( 'search/', '', $path ) ) );
    $args =
    [
        'query' => $query,
        'pages' => PageFactory::getPagesBySearchQuery( strtolower( $query ) )
    ];
    $content = ( new Template( 'search', $args ) )->getHtml();
}
else
{
    if ( str_starts_with( $path, 'level/' ) )
    {
        $slug = str_replace( '/', '', str_replace( 'level/', '', $path ) );
        $level = LevelFactory::getLevelBySlug( $slug );
        $content = ( ( $level ) ? new Template( 'level', [ 'level' => $level ] ) : new Template( '404' ) )->getHtml();
    }
    else
    {
        $slug = str_replace( '/', '', $path );
        $page = PageFactory::getPageBySlug( $slug );
        $content = ( ( $page ) ? new Template( 'page', [ 'page' => $page ] ) : new Template( '404' ) )->getHtml();
    }
}

$response = new Response( $content );
return $response->send();
