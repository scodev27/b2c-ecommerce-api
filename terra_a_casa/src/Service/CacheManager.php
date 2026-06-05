<?php

namespace App\Service;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class CacheManager
{
    private $cacheAdapter;

    public function __construct()
    {
        $this->cacheAdapter = new FilesystemAdapter();
    }

    public function get(string $key)
    {
        return $this->cacheAdapter->getItem($key)->get();
    }

    public function set(string $key, $value, int $ttl = 3600)
    {
        $item = $this->cacheAdapter->getItem($key);
        $item->set($value);
        $item->expiresAfter($ttl);
        $this->cacheAdapter->save($item);
    }
}
