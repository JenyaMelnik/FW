<?php
namespace Cache;

class CacheFile implements CacheInterface
{
    private $id = '';
    public $text = '';

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function get()
    {
        if (file_exists('./cache/file/' . $this->id) && time() - filemtime('./cache/file/' . $this->id) < 5) {
            echo 'FROM CACHE <br>';
            $this->text = unserialize(file_get_contents('./cache/file/' . $this->id));
            return true;
        } else {
            echo 'CREATE CACHE<br>';
            return false;

        }
    }

    public function set($value)
    {
        file_put_contents('./cache/file/' . $this->id, serialize($value));
    }

    public function write($text)
    {
        echo $text;
    }
}
