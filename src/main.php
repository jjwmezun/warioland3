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
if ( in_array( $path, [ '', '/' ] ) ) // Make root URL go to home page.
{
    $content = Template::generate( 'page', [ 'page' => PageFactory::getPageBySlug( 'home' ) ] );
}
else if ( $path === 'levels/' ) // Go to hard-coded levels page.
{
    $content = Template::generate( 'levels-archive', [ 'regions' => RegionFactory::getAllRegions() ] );
}
else if ( $path === 'search/' ) // Redirect search page with GET query to cleaner URL.
{
    $query = $request->query->get( 'query' );
    $response = new RedirectResponse( "/search/$query/" );
    $response->send();
}
else if ( str_starts_with( $path, 'search/' ) ) // Handle search page.
{
    $query = urldecode( str_replace( '/', '', str_replace( 'search/', '', $path ) ) );
    $args =
    [
        'query' => $query,
        'pages' => PageFactory::getPagesBySearchQuery( strtolower( $query ) )
    ];
    $content = Template::generate( 'search', $args );
}
else if ( str_starts_with( $path, 'level/' ) ) // Handle individual level page.
{    
    $slug = str_replace( '/', '', str_replace( 'level/', '', $path ) );
    $level = LevelFactory::getLevelBySlug( $slug );
    if ( $level )
    {
        $content = Template::generate( 'level', [ 'level' => $level ] );
    }
}
else
{
    $slug = str_replace( '/', '', $path );
    $page = PageFactory::getPageBySlug( $slug );
    if ( $page )
    {
        $content = Template::generate( 'page', [ 'page' => $page ] );
    }
}

$response = ( empty( $content ) )
    ? new Response( Template::generate( '404' ), Response::HTTP_NOT_FOUND )
    : $response = new Response( $content, Response::HTTP_OK );
return $response->send();
