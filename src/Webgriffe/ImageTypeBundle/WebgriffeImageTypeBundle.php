<?php

namespace Webgriffe\ImageTypeBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Webgriffe\ImageTypeBundle\DependencyInjection\Compiler\FormPass;

class WebgriffeImageTypeBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new FormPass());
    }

}
