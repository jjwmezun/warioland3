<?php

declare( strict_types = 1 );
namespace WarioLand3;

use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    public function testRoutes()
    {
        Connection::init();
        Template::init();
        $this->assertNotEmpty( ( new Template( 'page', [ 'page' => PageFactory::getPageBySlug( 'home' ) ] ) )->getHtml() );
    }

    public function testPages()
    {
        $this->assertNotNull( PageFactory::getPageBySlug( 'home' ) );
        $this->assertNotNull( PageFactory::getPageBySlug( 'minigolf' ) );
        $this->assertNull( PageFactory::getPageBySlug( 'asdkfnasdnf' ) );
    }

    public function testLevels()
    {
        $this->assertNotNull( LevelFactory::getLevelBySlug( 'n1-out-of-the-woods' ) );
        $this->assertNull( LevelFactory::getLevelBySlug( 'out-of-the-woods' ) );
        $this->assertNull( LevelFactory::getLevelBySlug( 'adjnfsjkdnf' ) );
    }
}