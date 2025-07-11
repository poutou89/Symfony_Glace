<?php

namespace App\Controller;

use App\Dto\ConversionInputDto;
use App\Dto\PercentageInputDto;
use App\Dto\ConversionOutputDto;
use App\Service\ConversionService;
use App\Service\PercentageService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


final class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    // public function index(Request $request, PercentageService $calculator): Response
    // {
    //     $number = floatval($request->get('number', 0));
    //     $percentage = floatval($request->get('percentage', 0));

    //     $inputDto = new PercentageInputDto($number, $percentage);
    //     $outputDto = $calculator->calculate($inputDto);

    //     return $this->render('accueil/home.html.twig', [
    //         'result' => $outputDto,
    //     ]);
    // }
    public function convert(Request $request, ConversionService $service): Response
{
    $amount = floatval($request->get('amount', 0));
    $rate = floatval($request->get('rate', 1)); // exemple : 1.1

    $input = new ConversionInputDto($amount, $rate);
    $output = $service->convert($input);

    return $this->render('accueil/home.html.twig', [
        'conversion' => $output,
        // 'pourcentage' => $PercentageOutputDto,
    ]);
}
    
}
