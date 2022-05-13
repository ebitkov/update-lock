<?php

namespace Ebitkov\UpdateLockBundle;

use Ebitkov\UpdateLockBundle\DependencyInjection\EbitkovUpdateLockBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EbitkovUpdateLockBundle extends Bundle
{
    public function getContainerExtension(): EbitkovUpdateLockBundleExtension
    {
        if (null === $this->extension) {
            $this->extension = new EbitkovUpdateLockBundleExtension();
        }

        return $this->extension;
    }

    public function getPath(): string
    {
        return dirname(__DIR__);
    }
}