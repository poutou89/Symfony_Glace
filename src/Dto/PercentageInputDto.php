<?php

namespace App\Dto;

class PercentageInputDto
{
    public function __construct(
        public float $number,
        public float $percentage
    ) {}
}