<?php

namespace View\Tests;

use Testing\TestCase;
use View\Map;

class MapTest extends TestCase
{
	private $map = null;
	private $page, $template = '';

	public function setUp ( )
	{
		$this->page = 'the dashboard';
		$this->template = 'pages/dashboard';
		$this->map = new Map ( array ( $this->page => $this->template ) );
	}

	/*
	|--------------------------------------------------------------------------
	| Constructor testing.
	|--------------------------------------------------------------------------
	*/

	/**
	 * @test
	 */
	public function __construct_withArrayWithValidEntries_addsEveryEntryToMap ( )
	{
		$entries = array ( 'the dashboard' => 'pages/dashboard', 'login' => 'pages/forms/login' );
		$map = new Map ( $entries );
		assertThat ( $this->property ( $map, 'mapping' ), is ( identicalTo ( $entries ) ) );
	}

	/*
	|--------------------------------------------------------------------------
	| Get method testing.
	|--------------------------------------------------------------------------
	*/

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 * @dataProvider nonStringValues
	 */
	public function get_withNonStringValueForPage_throwsException ( $value )
	{
		$this->map->get ( $value );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function get_withEmptyStringValueForPage_throwsException ( )
	{
		$this->map->get ( '' );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function get_withNonExistentPageValueForPage_throwsException ( )
	{
		$this->map->get ( 'non existent' );
	}

	/**
	 * @test
	 */
	public function get_withPageThatDoesExist_returnsCorrespondingTemplate ( )
	{
		assertThat ( $this->map->get ( $this->page ), is ( identicalTo ( $this->template ) ) );
	}
	
	/*
	|--------------------------------------------------------------------------
	| Add method testing.
	|--------------------------------------------------------------------------
	*/

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 * @dataProvider nonStringValues
	 */
	public function add_withNonStringValueForPage_throwsException ( $value )
	{
		$this->map->add ( $value, 'template' );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function add_withEmptyStringValueForPage_throwsException ( )
	{
		$this->map->add ( '', 'template' );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 * @dataProvider nonStringValues
	 */
	public function add_withNonStringValueForTemplate_throwsException ( $value )
	{
		$this->map->add ( 'page', $value );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function add_withEmptyStringValueForTemplate_throwsException ( )
	{
		$this->map->add ( 'page', '' );
	}

	/**
	 * @test
	 */
	public function add_withStringForPageAndStringForTemplate_setsEntryOnMap ( )
	{
		$page = 'the dashboard';
		$template = 'pages/dashboard';
		$this->map->add ( $page, $template );
		assertThat ( $this->property ( $this->map, 'mapping' ), hasEntry ( $page, $template ) );
	}
}