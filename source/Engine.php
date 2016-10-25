<?php

namespace View;

use	Xiaoler\Blade\Factory;

class Engine implements \Agreed\Technical\View\Engine
{
	private $blade = null;

	public function __construct ( Factory $blade )
	{
		$this->blade = $blade;
	}

	public function make ( $page, array $arguments = array ( ) )
	{
		echo $this->blade->make ( $page, $arguments );
	}
}