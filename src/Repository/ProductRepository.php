<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Product;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use DateTime;

class ProductRepository extends EntityRepository
{

    /**
     * @param $data
     * @return Product|object|string|null
     */
    public function createOrEditProduct($data)
    {
        if(empty($data['id'])){
            $product = new Product();
        }else{
            $product = $this->_em->getRepository(Product::class)->find($data['id']);
        }

        $validation_result = $this->validations($data);

        if(!empty($validation_result)){
            return $validation_result;
        }

        $product->setSku($data['sku']);
        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setIva($data['iva']);
        $product->setPrice($data['price']);

        $this->save($product);

        return $product;
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function save(Product $product): bool
    {
        try {
            if (!$this->_em->contains($product)) {
                $this->_em->persist($product);
            }
            $this->_em->flush();
            return true;
        } catch (OptimisticLockException | ORMException $e) {
            return false;
        }
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function delete(Product $product): bool
    {
        $now = new DateTime();
        $product->setDeletedAt($now);

        return $this->save($product);
    }

    /**
     * @param $data
     * @return string
     */
    private function validations($data): string
    {
        $message = '';

        if(empty($data['sku'])){
            $message = "sku cannot be empty";
        }
        if(empty($data['name'])){
            $message = "name cannot be empty";
        }
        if($data['price'] < 0){
            $message = "price cannot be less than 0";
        }
        if($data['iva'] < 0 || $data['iva'] > 100){
            $message = "iva: 0-100%";
        }

        return $message;
    }

}