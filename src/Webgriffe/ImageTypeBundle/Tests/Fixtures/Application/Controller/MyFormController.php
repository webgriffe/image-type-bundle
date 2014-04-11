<?php
/**
 * @author Manuele Menozzi <mmenozzi@webgriffe.com>
 */

namespace Webgriffe\ImageTypeBundle\Tests\Fixtures\Application\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;
use Symfony\Component\HttpFoundation\Response;
use Webgriffe\ImageTypeBundle\Tests\Fixtures\Application\Entity\MyEntity;

class MyFormController extends Controller
{
    public function indexAction()
    {
        $object = new MyEntity();
        $form = $this->createFormBuilder($object)
            ->add('name')
            ->add('image')
            ->getForm();

        /** @var FilesystemLoader $twigLoader */
        $twigLoader = $this->get('twig.loader');
        $twigLoader->addPath(__DIR__ . '/../Resources/views/');
        return $this->render(
            'MyFormController\index.html.twig',
            array('form' => $form->createView())
        );
    }
} 