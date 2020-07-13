<?php 
require 'vendor/autoload.php';
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;

// url
$term = 'mobil';
$url = 'https://www.olx.co.id/items/q-'.$term;

$client = new Client();
$res = $client->request('GET',$url);
$html = quoted_printable_decode($res->getBody());

// go get the data from url
$crawler = new Crawler($html);
$nodeValues = $crawler->filter('.EIR5N > a > div')->each(function (Crawler $node, $i) {
    // echo  $node->html().'<br>';
    $title = $node->filter('span[data-aut-id="itemTitle"]')->text();
    $price = $node->filter('span[data-aut-id="itemPrice"]')->text();
    $item = [$title,$price];
    
    print_r($item);
});
// loop through the data

// search for values I want


 ?>