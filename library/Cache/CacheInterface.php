<?php
namespace Cache;


interface CacheInterface
{
    public function get();
    public function set($value);
}
