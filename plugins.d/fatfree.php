<?php

class CensusFatFree extends CensusPluginRegexp
{
	protected $id = "fatFree";
	protected $regexp = "Fat-Free Framework";
	protected $caseSensitive = false;
	protected $onlyHeaders = true;
}
CensusPluginRegister::instance()->register( "CensusFatFree" );
