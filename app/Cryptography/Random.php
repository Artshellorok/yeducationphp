<?php

namespace App\Cryptography;

class Random 
{
    protected $num;

    public function __construct($num = null)
    {
        $this->num = $num;
    }

    public function gen($min, $max)
    {
        return new Random(random_int($min,$max)); 
    }
    
    public function gen_rand()
    {
        return $this->gen(
            hexdec(bin2hex(random_bytes(1))), 
            hexdec(bin2hex(random_bytes(4)))
        );
    }
    
    public function get()
    {
        return $this->num;
    }

    public function hex()
    {
        return new Random(dechex($this->num));
    }
    public function secure_hash()
    {
        return new Random(
            hash("sha256", $this->base64()->get())
        );
    }
    public function base64()
    {
        return new Random(base64_encode((string) $this->num));
    }
}