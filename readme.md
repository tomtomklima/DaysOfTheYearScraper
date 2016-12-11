Want to have cool list of occasions in given day or month? You hit the right package!
 
 ##Installation
 ```
 composer`require tomtomklima/daysoftheyearscraper
 ```
 
 ##Usage
 
 ```php
 require_once __DIR__ .'/vendor/autoload.php';
 
 $scraper = new tomtomklima\DaysOfTheYearScraper\DaysOfTheYearScraper();
 
 $json = $scraper->getMonth(2016, 03);```
 
 
 ##Content
 
 Function getMonth returns object of elements; each element has header, description, link to actual page and object img with src and alt text. 
  
  