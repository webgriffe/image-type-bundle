<?php
/**
 * @author Manuele Menozzi <mmenozzi@webgriffe.com>
 */

namespace Webgriffe\ImageTypeBundle\Example\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MyFormController extends Controller
{
    public function indexAction()
    {
        return new Response('Hello World!');
    }
} 