<?php

namespace App\Service;

use App\Dto\PercentageInputDto;
use App\Dto\PercentageOutputDto;

class PercentageService
{
    public function calculate(PercentageInputDto $dto): PercentageOutputDto
    {
        $result = ($dto->number * $dto->percentage) / 100;
        $label = $this->getLabel($dto->percentage);

        return new PercentageOutputDto($result, $label);
    }

    private function getLabel(float $percentage): string
    {
        return match (true) {
            $percentage >= 90 => 'Très haut',
            $percentage >= 50 => 'Moyen',
            default           => 'Bas',
        };
    }
}