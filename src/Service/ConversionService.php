<?php

namespace App\Service;

use App\Dto\ConversionInputDto;
use App\Dto\ConversionOutputDto;

class ConversionService
{
    public function convert(ConversionInputDto $dto): ConversionOutputDto
    {
        $result = $dto->getAmountInEuro() * $dto->getExchangeRate();
        return new ConversionOutputDto($result);
    }
}