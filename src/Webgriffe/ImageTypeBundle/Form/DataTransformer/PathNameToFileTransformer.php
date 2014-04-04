<?php
/**
 * Created by JetBrains PhpStorm.
 * User: azambon
 * Date: 12/09/13
 * Time: 16.47
 * To change this template use File | Settings | File Templates.
 */

namespace Webgriffe\ImageTypeBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PathNameToFileTransformer implements DataTransformerInterface
{
    /**
     * @var string
     */
    private $webPath;

    public function __construct($webPath = '')
    {
        $this->webPath = $webPath;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($file)
    {
        //Non bisogna convertire un oggetto file nel relativo path, dato che il campo ImageUpload si aspetta di
        //ricevere un oggetto di tipo File dal backend
        return $file;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($pathname)
    {
        if (empty($pathname)) {
            return null;
        }

        $path = $this->webPath . DIRECTORY_SEPARATOR . $pathname;
        return new UploadedFile($path, basename($path), null, null, null, true);
    }
}
