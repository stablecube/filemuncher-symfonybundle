<?php

namespace StableCube\FileMuncherBundle\Services;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use StableCube\FileMuncherClient\Models\JsonWebToken;
use StableCube\FileMuncherClient\Services\TokenStorageAdapterBase;

class SymfonyFilesystemTokenStorageAdapter extends TokenStorageAdapterBase
{
    private $cache;
    private $cacheKey = 'filemuncher';

    function __construct(
        string $cacheDir
    )
    {
        $this->cache = new FilesystemAdapter(
            $namespace = $this->cacheKey,
            $defaultLifetime = 3600,
            $directory = $cacheDir
        );
    }

    private function getCache() : FilesystemAdapter
    {
        return $this->cache;
    }

    public function getCacheKey() : string
    {
        return $this->cacheKey;
    }

    public function getToken() : ?JsonWebToken
    {
        $cacheItem = $this->getCache()->getItem('backend-token');
        if (!$cacheItem->isHit()) {
            return null;
        }

        $token = $cacheItem->get();

        return $token;
    }

    public function setToken(JsonWebToken $token): void
    {
        $cacheItem = $this->getCache()->getItem('backend-token');
        $cacheItem->set($token);
        $this->getCache()->save($cacheItem);
    }
}