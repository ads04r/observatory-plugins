<?php

CensusPluginRegister::instance()->register( "CensusPluginScrabbleScore" );

$base_dir = dirname(__DIR__);
global $scrabbleScorings;
$scrabbleScorings = json_decode(file_get_contents($base_dir . "/etc/scrabbleScores.json"), true);

class CensusPluginScrabbleScore extends CensusPlugin
{
	protected $id = "scrabbleScore";

	private function score($text, $language)
	{
		global $scrabbleScorings;

		$tt = strtolower($text);
		$score = 0;
		$letters = array_keys($scrabbleScorings);
		usort($letters, function($a, $b) { return strlen($b) - strlen($a); });
		foreach($letters as $letter)
		{
			$scores = $scrabbleScorings[$letter];

			$l1 = strlen($tt);
			$tt = str_replace(strtolower($letter), "", $tt);
			$l2 = strlen($tt);

			$letterscore = 0;
			if(array_key_exists($language, $scores))
			{
				$letterscore = $scores[$language];
			}
			$score = $score + (($l1 - $l2) * $letterscore);
		}

		return $score;
	}

	public function applyTo( $curl )
	{
		global $scrabbleScorings;
		$keys = array_keys($scrabbleScorings);
		$languages = array_keys($scrabbleScorings[$keys[0]]);

		$r = array();
		foreach($languages as $lang)
		{
			$r[$lang] = $this->score($curl->text, $lang);
		}
		return $r;
	}
}
