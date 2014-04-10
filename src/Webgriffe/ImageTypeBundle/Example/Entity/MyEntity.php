<?php
/**
 * @author Manuele Menozzi <mmenozzi@webgriffe.com>
 */

namespace Webgriffe\ImageTypeBundle\Example\Entity;


use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;

class MyEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var File
     */
    private $image;

    /**
     * @var string
     */
    private $image_path;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param File $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return File
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image_path
     */
    public function setImagePath($image_path)
    {
        $this->image_path = $image_path;
    }

    /**
     * @return string
     */
    public function getImagePath()
    {
        return $this->image_path;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}