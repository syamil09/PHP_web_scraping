<?php 
require 'vendor/autoload.php';
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;

// url
$term = 'laptop';
$url = 'https://www.olx.co.id/items/q-'.$term;

// go get the data from url
$client = new Client();
$res = $client->request('GET',$url);
$html = quoted_printable_decode($res->getBody());
// echo $html;
// loop through the data
$crawler = new Crawler($html);
$items = $crawler->filter('.EIR5N > a > div')->each(function (Crawler $node, $i) {
    // echo  $node->html().'<br>';
    $title = $node->filter('span[data-aut-id="itemTitle"]')->text();
    $price = $node->filter('span[data-aut-id="itemPrice"]')->text();
    $item = [
    	'title' => $title,
    	'price' => $price
    ];
    
    return $item;
});

$file = fopen('data.csv', 'w');

foreach ($items as $item) {
	fputcsv($file, $item);
}
fclose($file);
print_r($items);


 ?>