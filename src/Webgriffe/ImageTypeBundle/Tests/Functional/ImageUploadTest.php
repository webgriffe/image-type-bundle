<?php
/**
 * @author Manuele Menozzi <mmenozzi@webgriffe.com>
 */

namespace Webgriffe\ImageTypeBundle\Tests\Functional;


use Liip\FunctionalTestBundle\Test\WebTestCase;

class ImageUploadTest extends WebTestCase
{
    const TEST_IMAGE = 'test-image.jpg';

    private $filesToDelete = array();

    public function testImageUpload()
    {
        $client = static::createClient();

        $this->loadFixtures(array());

        $crawler = $client->request('GET', '/');
        $this->assertEquals('Hello World!', $crawler->filter('h1')->text());
        $this->assertCount(1, $crawler->filter('form'));

        $form = $crawler->selectButton('Save')->form();
        $this->uploadImage('my-image.jpg', __DIR__ . '/../../../../../web/uploads/gallery');
        $form['form[name]'] = 'My great image';
        $form['form[image]'] = '/uploads/gallery/my-image.jpg';
        $client->submit($form);

                
    }

    /**
     * This function simulates the AJAX upload performed via OneupUploaderBundle.
     *
     * @param $finalFileName string The name of the uploaded file after it has been uploaded
     * @param $destinationPath string The destination path of the uploaded file. This must be the same defined on the
     * OneupUploader mapping configuration (web/uploads/{mapping_name}).
     * @throws \Exception
     */
    private function uploadImage($finalFileName, $destinationPath)
    {
        $testImagePath = __DIR__ . '/../Fixtures/' . self::TEST_IMAGE;
        if (!file_exists($testImagePath)) {
            throw new \Exception('Missing image file '.$testImagePath);
        }

        $destination = rtrim($destinationPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $finalFileName;

        if (!file_exists(dirname($destination))) {
            mkdir(dirname($destination), 0775, true);
        }

        if (!copy($testImagePath, $destination)) {
            throw new \Exception('Cannot move test file to gallery directory');
        }

        $this->filesToDelete[] = $destination;
    }

    public function tearDown()
    {
        foreach ($this->filesToDelete as $file) {
            @unlink($file);
        }
    }
} 