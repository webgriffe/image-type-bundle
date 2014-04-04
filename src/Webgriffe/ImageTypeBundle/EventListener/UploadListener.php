<?php
/**
 * Created by JetBrains PhpStorm.
 * User: azambon
 * Date: 12/09/13
 * Time: 15.18
 * To change this template use File | Settings | File Templates.
 */

namespace Webgriffe\ImageTypeBundle\EventListener;

use Oneup\UploaderBundle\Event\PostPersistEvent;
use Symfony\Component\HttpFoundation\File\File;

class UploadListener
{
    public function onUpload(PostPersistEvent $event)
    {
        /** @var File $file */
        $file = $event->getFile();

        $response = $event->getResponse();
        $response['uploaded_file_path_name'] = '/uploads/gallery/'.$file->getFilename();
    }
}
