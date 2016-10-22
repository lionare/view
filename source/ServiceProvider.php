<?php

namespace View;

use Agreed\Technical\Configuration;

use Support\ServiceProvider as BaseServiceProvider;

use	Xiaoler\Blade\Compilers\BladeCompiler;
use	Xiaoler\Blade\Engines\CompilerEngine;
use	Xiaoler\Blade\Factory;
use	Xiaoler\Blade\FileViewFinder;

class ServiceProvider extends BaseServiceProvider
{
	public function register ( )
	{
		$this->application->bind ( Engine::class, function ( Factory $factory, Map $map )
		{
			return new Engine ( $factory, $map );
		} );

		$this->application->share ( 'Xiaoler\\Blade\\Factory', function ( Configuration $configuration )
		{
			$cache = cache_path ( ) . '/engines/blade';

			$compiler = new BladeCompiler ( $cache );

			$engine = new CompilerEngine ( $compiler );
			$finder = new FileViewFinder ( array ( $configuration->get ( 'theme path' ) ) );

			$factory = new Factory ( $engine, $finder );

			return $factory;
		} );
	}
}