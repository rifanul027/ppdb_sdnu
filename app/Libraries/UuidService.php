<?php

namespace App\Libraries;

class UuidService
{
    /**
     * Generate UUID v4
     * 
     * @return UuidObject
     */
    public function uuid4()
    {
        $uuid = $this->generateV4();
        return new UuidObject($uuid);
    }

    /**
     * Generate UUID v4 string directly
     * 
     * @return string
     */
    public function generate()
    {
        return $this->generateV4();
    }

    /**
     * Generate UUID v4 string
     * 
     * @return string
     */
    private function generateV4()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}

class UuidObject
{
    private $uuid;

    public function __construct($uuid)
    {
        $this->uuid = $uuid;
    }

    public function toString()
    {
        return $this->uuid;
    }

    public function __toString()
    {
        return $this->uuid;
    }
}
