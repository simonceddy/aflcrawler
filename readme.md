# AFLCrawler

AFLCrawler is a PHP command line utility for fetching data from afltables.com (I am not affiliated in any way with afltables.com).

It is very much a work in progress, and I'm going to go out on a limb and suggest it will have pretty limited use for your own project. Unless you need AFL stats...

__Please note:__ currently utility simply performs a dump of the West Coast Eagles data. The next step is to allow persisting the results.

## What is it and why

This utility provides a method for turning the data from AFL Tables into serializable objects.

While AFLCrawler is definitiely a fairly niche utility, it provides me with a convenience method to make said data usable.

## Issues and Bugs

Currently the code is very brittle, as it relies on the HTML it processes to follow a certain schema.

All data comes from afltables.com, where there are currently no advanced statistics available. The site also has its limits. It does, however, have pretty traversable HTML.

## Basic Use

The process will usually be along the lines of:

- Retrieve HTML data from either a HTTP request/response or a locally stored file,
- Pass the HTML to a Crawler class,
- The Crawler class will loop through specific nodes and extract the relevant data,
- The Crawler will then pass the data to the relevant Factory, which builds and returns the appropriate Model,
- Related Models may also be created at this stage,
- The resulting Model is stored in an array, which is returned by the Crawler when the process is complete.

A quick example using a locally stored copy of the 2018 Season stats:

```php
// Get our HTML file
$html = file_get_contents(__DIR__.'/storage/2018.html');

// Init our appropriate Crawler
$crawler = new AflCrawler\Crawler\SeasonTotalsCrawler;

// Let it go to town!
$result = $crawler->crawl($html);

var_dump($result); // HUGE AMOUNTS OF DATA
```

And using __AflCrawler\Http\Client__ to request the html from afltables.com:

```php
// The AflCrawler Http Client is a simple wrapper around GuzzleHTTP's Client
$client = new AflCrawler\Http\Client;

// The AflCrawler client contains some convenience methods for afltables.com
$response = $client->getSeason(2018);

// Get the HTML content as a string from our response
$html = $response->getBody()->getContents();

// As before we init our appropriate Crawler
$crawler = new AflCrawler\Crawler\SeasonTotalsCrawler;

// and... Let it go to town!
$result = $crawler->crawl($html);

var_dump($result); // HUGE AMOUNTS OF DATA
```

### Command Line

At present AFLCrawler contains two Commands:

- __AflCrawler\Console\Fetch\Season__ - `fetch:season` - which fetches data for a given season, and...
- __AflCrawler\Console\Fetch\HtmlSeason__ - `fetch:html:season` - which fetches the html body for a given season and stores a local copy (convenience for being occasionally offline).

AFLCrawler uses the Symfony/Console component and comes with a script for running a very simple command line utility (_bin/aflcrawler_), however commands require no extra bootstrapping and can be registered in any Symfony/Console applications.

## TODO

- Implement storage and bridges for Redis, Doctrine, JSON, YAML,
- Use config for factory/model resolution to allow using different model classes (e.g. Eloquent),
- Add features for fetching data for an individual player or match,
- Add feature for fetching all match data for a single season,
- Tidy up