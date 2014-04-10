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

        $client->request('GET', '/');
        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
} 