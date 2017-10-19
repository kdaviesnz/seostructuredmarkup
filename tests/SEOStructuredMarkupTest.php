<?php

require_once("src/ISEOStructuredMarkup.php");
require_once("src/SEOStructuredMarkup.php");


class SEOStructuredMarkupTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }

    public function tearDown()
    {

    }

    public function testSEOStructuredMarkup()
    {

       $product = array(
           "title" => "A widget",
           "images" => array(
               "large" => array(
                   "src" => "http://example.com/image.jpg"
               )
           ),
           "description" => "This is a widget",
           "brand" => "Widget Brand",
           "rating" => "8",
           "currency" => "USD",
           "merchant" => "Widget Co",
           "price" => "100.00",
           "organization" => "Widget Org"
       );
        $structuredMarkup = new \kdaviesnz\seostructuredmarkup\SEOStructuredMarkup("product", $product);
        echo $structuredMarkup;


    }

}
