<?php

namespace App\DTO;

class ActivityDTO
{
    public int $register;
    public int $delete;

    public function __construct(
        int $register,
        int $delete,
    )
    {
        $this->register = $register;
        $this->delete = $delete;
    } 
}