<?php

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles = array_merge($bundles, [
                new Symfony\Bundle\DebugBundle\DebugBundle(),
                new Symfony\Bundle\TwigBundle\TwigBundle(),
                new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle(),
            ]);
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load("{$this->getConfigDir()}/env/{$this->getEnvironment()}.yml");
    }

    protected function getKernelParameters()
    {
        return array_merge(parent::getKernelParameters(), [
            'kernel.config_dir'    => $this->getConfigDir(),
            'kernel.resources_dir' => $this->getResourcesDir(),
            'kernel.public_dir'    => $this->getPublicDir(),
            'kernel.temp_dir'      => $this->getTempDir(),
        ]);
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return "{$this->getTempDir()}/cache/{$this->getEnvironment()}";
    }

    public function getLogDir()
    {
        return "{$this->getTempDir()}/logs";
    }

    private function getTempDir()
    {
        return "{$this->rootDir}/var";
    }

    private function getConfigDir()
    {
        return "{$this->rootDir}/etc";
    }

    private function getResourcesDir()
    {
        return "{$this->rootDir}/res";
    }

    private function getPublicDir()
    {
        return "{$this->rootDir}/public";
    }
}
