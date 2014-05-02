<?php
require_once 'xpath.php';
set_time_limit(0);
$startUrl = "http://www.koreaindo.net/search/label/Korean%20Drama";

// anchor title "//div[@class= 'date-outer']//h2[@class= 'post-title entry-title']/a/text()"
// anchor title link "//div[@class= 'date-outer']//h2[@class= 'post-title entry-title']/a/@href"
// image query "//div[@class= 'post hentry']//img/@src"


function scrapeYoutube($url){
	$baseUrl = "http://www.koreaindo.net/";
	$array = array();
	$xpath = new XPATH($url);	

	//$imageSrcQuery = $xpath->query("//div[@class= 'post hentry']//img/@src");
	$linkTitleQuery = $xpath->query("//div[@class= 'date-outer']//h2[@class= 'post-title entry-title']/a/text()");
	$linkHrefQuery = $xpath->query("//div[@class= 'date-outer']//h2[@class= 'post-title entry-title']/a/@href");
	//$linkOwnerQuery = $xpath->query("//td[@class='pl-video-owner']/a/text()");
	//$linkOwnerHrefQuery = $xpath->query("//td[@class='pl-video-owner']/a/@href");
	//$linkTimestampQuery = $xpath->query("//div[@class='timestamp']");

	$fh = fopen("koreaindoparse.txt", "a+");
	for($x=0; $x<$linkHrefQuery->length; $x++){

		//$string = $array[$x]['imageSrc'] = $imageSrcQuery->item($x)->nodeValue ."*";
		$string = $array[$x]['linkTitle'] = $linkTitleQuery->item($x)->nodeValue ."*";
		$string .= $array[$x]['linkHref'] = $baseUrl . $linkHrefQuery->item($x)->nodeValue;
		//$string .= $array[$x]['linkOwner'] = $linkOwnerQuery->item($x)->nodeValue ."*";
		//$string .= $array[$x]['linkOwnerHref'] = $baseUrl . $linkOwnerHrefQuery->item($x)->nodeValue ."*";
		//$string .= $array[$x]['linkTimestamp'] = $linkTimestampQuery->item($x)->nodeValue ."*";

		fwrite($fh, $string ."\n");
		//$array[$x]['imageSrc'] = $imageSrcQuery->item($x)->nodeValue;
		//$array[$x]['linkTitle'] = $linkTitleQuery->item($x)->nodeValue;
		//$array[$x]['linkHref'] = $baseUrl . $linkHrefQuery->item($x)->nodeValue;
		//$array[$x]['linkOwner'] = $linkOwnerQuery->item($x)->nodeValue;
		//$array[$x]['linkOwnerHref'] = $baseUrl . $linkOwnerHrefQuery->item($x)->nodeValue;
		//$array[$x]['linkTimestamp'] = $linkTimestampQuery->item($x)->nodeValue;

	}
	fclose($fh);
	return $array;
}

$data = scrapeYoutube("http://www.koreaindo.net/search/label/Korean%20Drama");


echo "<pre>";
print_r($data);
