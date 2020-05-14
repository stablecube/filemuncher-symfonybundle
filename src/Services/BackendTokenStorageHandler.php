<?php

namespace StableCube\FileMuncherBundle\Services;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;
use StableCube\FileMuncherClient\Services\FileMuncherClientV1;

class BackendTokenStorageHandler
{
    private $cacheKey = 'filemuncher-backend-token';
    private $cache;

    function __construct(
        TokenStorageAdapter $storageAdapter,
        string $cacheDirectory
    )
    {
        $this->cache = new FilesystemAdapter(
            $namespace = $this->cacheKey,
            $defaultLifetime = 3600,
            $directory = $cacheDirectory
        );

        $storageAdapter->registerStoreTokenCallback(array($this => 'storeTokenCallbackHandler'));
        $storageAdapter->registerRetrieveTokenCallback(array($this => 'retrieveTokenCallbackHandler'));
    }

    private function getCache() : FilesystemAdapter
    {
        return $this->cache;
    }

    public function storeTokenCallbackHandler(string $token) : void
    {
        $this->getCache()->set($this->cacheKey, $token);
    }

    public function retrieveTokenCallbackHandler() : ?JsonWebToken
    {
        return $this->getCache()->get($this->cacheKey);
    }
}