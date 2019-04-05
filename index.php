<?php
require __DIR__.'/vendor/autoload.php';

$result = AflCrawler\Crawl::season(__DIR__.'/storage/2011.html');

dd($result['teams']['ge']);
