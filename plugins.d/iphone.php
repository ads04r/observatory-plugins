<?php

class CensusPluginIPhone extends CensusPluginRegexp
{
	protected $id = "iphone";
	protected $regexp = "<link[^>]+rel=\\\"apple-touch-icon";
	protected $caseSensitive = false;
}
CensusPluginRegister::instance()->register( "CensusPluginIPhone" );

