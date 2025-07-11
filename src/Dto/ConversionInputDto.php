<?php 

namespace App\Dto;

class ConversionInputDto
{
    private float $amountInEuro;
    private float $exchangeRate;

    public function __construct(float $amountInEuro, float $exchangeRate)
    {
        $this->amountInEuro = $amountInEuro;
        $this->exchangeRate = $exchangeRate;
    }

    public function getAmountInEuro(): float
    {
        return $this->amountInEuro;
    }

    public function getExchangeRate(): float
    {
        return $this->exchangeRate;
    }
}