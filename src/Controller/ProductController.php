<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends AbstractController
{

    /**
     * @Route("/products/list")
     * @return JsonResponse
     */
    public function productsList(): JsonResponse
    {
        $response = new JsonResponse();
        $serializer = $this->container->get('serializer');
        $products = $serializer->serialize($this->getDoctrine()->getRepository(Product::class)->findBy(['deletedAt' => null]), 'json');

        $response->setData(json_decode($products, true));

        return $response;
    }

    /**
     * @Route("/products/create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function createProduct(Request $request): JsonResponse
    {

        $response = new JsonResponse();

        $data = json_decode($request->getContent(), true);
        $data['id'] = null;
        $product = $this->getDoctrine()->getRepository(Product::class)->createOrEditProduct($data);

        $serializer = $this->container->get('serializer');
        $product_json = json_decode($serializer->serialize($product, 'json'), true);


        $response->setData(
            ['success' => true, 'message' => 'Product has been created', 'product'=> $product_json ]
        );

        return $response;
    }

    /**
     * @Route("/products/edit", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function editProduct(Request $request): JsonResponse
    {
        $response = new JsonResponse();

        $data = json_decode($request->getContent(), true);
        if(empty($data['id'])){
            $response->setData(['success' => false, 'message' => 'Product Id is required']);
            return $response;
        }
        $product = $this->getDoctrine()->getRepository(Product::class)->createOrEditProduct($data);

        $serializer = $this->container->get('serializer');
        $product_json = json_decode($serializer->serialize($product, 'json'), true);

        $response->setData(
            ['success' => true, 'message' => 'Product has been edited', 'product'=> $product_json]
        );

        return $response;
    }

    /**
     * @Route("/products/delete", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteProduct(Request $request): JsonResponse
    {
        $response = new JsonResponse();

        $data = json_decode($request->getContent(), true);
        if(empty($data['id'])){
            $response->setData(['success' => false, 'message' => 'Product Id is required']);
            return $response;
        }

        $product = $this->getDoctrine()->getRepository(Product::class)->find($data['id']);
        $result = $this->getDoctrine()->getRepository(Product::class)->delete($product);

        if($result){
            $response->setData(['success' => true, 'message' => 'Product has been deleted']);
        }else{
            $response->setData(['success' => false, 'message' => 'Product has not been deleted']);
        }

        return $response;
    }

}