<?php
/**
 * @author Manuele Menozzi <mmenozzi@webgriffe.com>
 */

namespace Webgriffe\ImageTypeBundle\Tests\Functional;


use Liip\FunctionalTestBundle\Test\WebTestCase;

class ImageUploadTest extends WebTestCase
{
    public function testImageUpload()
    {
        $client = static::createClient();

        $this->loadFixtures(array());

        $crawler = $client->request('GET', '/');
        $this->assertEquals('Hello World!', $crawler->filter('h1')->text());
    }
} 