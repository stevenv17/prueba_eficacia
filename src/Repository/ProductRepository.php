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
     * @return Product
     */
    public function createOrEditProduct($data): Product
    {
        //validar data aqui °°°°°°

        if(empty($data['id'])){
            $product = new Product();
        }else{
            $product = $this->_em->getRepository(Product::class)->find($data['id']);
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

}