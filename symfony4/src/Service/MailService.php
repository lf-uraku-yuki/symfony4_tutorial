<?php
namespace App\Service;

class MailService
{
    private $from_address;

    public function __construct($from_address)
    {
        $this->from_address = $from_address;
    }
}