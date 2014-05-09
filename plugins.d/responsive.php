<?php

class CensusPluginResponsive extends CensusPluginRegexp
{
	protected $id = "responsive";
	protected $regexp = "<meta[^>]+name=\\\"viewport\\\"";
	protected $caseSensitive = false;
}
CensusPluginRegister::instance()->register( "CensusPluginResponsive" );

