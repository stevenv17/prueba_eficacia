<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Sale;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class SaleController extends AbstractController
{

    /**
     * @Route("/sales/list")
     * @return JsonResponse
     */
    public function salesList(): JsonResponse
    {
        $response = new JsonResponse();
        $serializer = $this->container->get('serializer');
        $sales = $serializer->serialize($this->getDoctrine()->getRepository(Sale::class)->findBy(['deletedAt' => null]), 'json');

        $response->setData(json_decode($sales, true));

        return $response;
    }

    /**
     * @Route("/sales/sell", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function sell(Request $request): JsonResponse
    {

        $response = new JsonResponse();

        $data = json_decode($request->getContent(), true);
        $billNumber = $this->getDoctrine()->getRepository(Sale::class)->sell($data['products'], $data['customer']);

        $sales = $this->getDoctrine()->getRepository(Sale::class)->findBy(['billNumber' => $billNumber]);

        $sale_json = ['details' => [], 'totals' => ['iva' => 0, 'subtotal' => 0, 'total' => 0]];
        foreach ($sales as $sale){
            $sale_json['details'][] = [
                'product' => $sale->getProduct()->getName(),
                'quantity' => $sale->getQuantity(),
                'unit_value' => ($sale->getSubtotal()/$sale->getQuantity()),
                'iva' => $sale->getIva(),
                'subtotal' => $sale->getSubTotal(),
                'total' => $sale->getTotal()
            ];

            $sale_json['totals']['iva'] += $sale->getIva();
            $sale_json['totals']['subtotal'] += $sale->getSubTotal();
            $sale_json['totals']['total'] += $sale->getTotal();
        }

        $response->setData(
            ['success' => true, 'message' => 'Product has been created', 'sale'=> $sale_json ]
        );

        return $response;
    }

}