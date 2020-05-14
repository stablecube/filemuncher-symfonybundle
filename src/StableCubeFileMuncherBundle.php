<?php

namespace StableCube\FileMuncherBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use StableCube\FileMuncherBundle\DependencyInjection\FilemuncherExtension;


class StableCubeFileMuncherBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new FilemuncherExtension();
    }
}
