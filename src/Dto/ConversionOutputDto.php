<?php

namespace App\Dto;

class ConversionOutputDto
{
    private float $amountInDollar;

    public function __construct(float $amountInDollar)
    {
        $this->amountInDollar = $amountInDollar;
    }

    public function getAmountInDollar(): float
    {
        return $this->amountInDollar;
    }
}