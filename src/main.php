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
    $content = ( new Template( 'page', [ 'page' => Page::getPageBySlug( 'home' ) ] ) )->getHtml();
}
else if ( $path === 'search/' )
{
    $content = ( new Template( 'search', [ 'query' => $request->query->get( 'query' ) ] ) )->getHtml();
}
else
{
    $content = ( new Template( '404' ) )->getHtml();
}

$response = new Response( $content );
return $response->send();
