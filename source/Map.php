<?php

namespace View;

use InvalidArgumentException;

class Map
{
	protected $mapping = array ( );

	public function __construct ( array $mapping = array ( ) )
	{
		foreach ( $mapping as $page => $template )
			$this->add ( $page, $template );
	}

	public function get ( $page )
	{
		$this->check ( $page );
		if ( ! $this->has ( $page ) )
			throw new InvalidArgumentException ( "$page could not be found inside the mapping." );
		return $this->mapping [ $page ];
	}

	public function add ( $page, $template )
	{
		$this->check ( $page );
		$this->check ( $template );
		$this->mapping [ $page ] = $template;
	}

	public function has ( $page )
	{
		return ( bool ) isset ( $this->mapping [ $page ] );
	}

	private function check ( $page )
	{
		if ( ! is_string ( $page ) or empty ( $page ) )
			throw new InvalidArgumentException ( '$page or $template must be a non empty string.' );
	}
}