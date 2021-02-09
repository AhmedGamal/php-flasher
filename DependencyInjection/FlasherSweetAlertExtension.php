<?php

namespace Flasher\SweetAlert\Symfony\DependencyInjection;

use Flasher\Symfony\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

final class FlasherSweetAlertExtension extends Extension
{
    /**
     * @inheritDoc
     */
    protected function getConfigFileLocator()
    {
        return new FileLocator(__DIR__.'/../Resources/config');
    }

    /**
     * @inheritDoc
     */
    protected function getConfigClass()
    {
        return new Configuration();
    }
}
