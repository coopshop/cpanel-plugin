<?php

class MicroweberStorage
{
    private $file;
    private $storage;

    public function __construct($file = '/usr/local/cpanel/microweber/storage/settings.json')
    {
        $this->file = $file;

        if (!is_file($file)) {
            touch($file);
        }


    }

    public function read()
    {
        $data = file_get_contents($this->file);
        $this->storage = @json_decode($data, true);
        return $this->storage;
    }

    public function save($data)
    {
        if ($this->storage and is_array($this->storage)) {
            $data = array_merge($this->storage, $data);
        }
        if (is_array($data) and !empty($data)) {
            $data = array_map("trim", $data);
        }

        $data = json_encode($data);
        return file_put_contents($this->file, $data);
    }
}