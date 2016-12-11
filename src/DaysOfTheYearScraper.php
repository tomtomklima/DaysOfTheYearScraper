<?php

namespace tomtomklima\DaysOfTheYearScraper;

use Sunra\PhpSimple\HtmlDomParser;

class DaysOfTheYearScraper {
	
	private $htmlDomParser;
	private $htmlPurifier;
	
	function __construct() {
		$this->htmlDomParser = new HtmlDomParser;
		
		$purifierConfig = \HTMLPurifier_Config::createDefault();
		//$purifierConfig->set();
		$this->htmlPurifier = new \HTMLPurifier($purifierConfig);
	}
	
	function getMonth($year, $month) {
		$month = str_pad($month, 2, 0, STR_PAD_LEFT);
		$monthUrl = "https://www.daysoftheyear.com/days/$year/$month/";
		
		//$html = file_get_contents($monthUrl);
		$html = file_get_contents('example.html');
		$purifiedHtml = $this->htmlPurifier->purify($html);
		
		$dom = $this->htmlDomParser->str_get_html($purifiedHtml);
		
		$dom = $dom->find('div[class=topBannerWrapper]', 0);
		$nodes = $dom->find('div[class=banner]');
		
		$result = [];
		for ($i = 0; $i < count($nodes); $i ++) {
			$result[$i]['img'] = $nodes[$i]->find('img', 0)->attr;
			
			$innerDiv = $nodes[$i]->find('div', 0);
			
			$innerLink = $innerDiv->find('h2', 0)->find('a', 0);
			$result[$i]['header'] = $innerLink->innertext();
			$result[$i]['link'] = $innerLink->attr['href'];
			
			$result[$i]['description'] = $innerDiv->find('div', 0)->innertext();
		}
		
		return json_encode($result, JSON_PRETTY_PRINT);
	}
}