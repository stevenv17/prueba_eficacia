<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Sale;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class SaleRepository extends EntityRepository
{

    /**
     * @param $products
     * @param $customer
     * @return int
     * @throws NonUniqueResultException
     */
    public function sell($products, $customer): int
    {
        $sale = ['details' => [], 'totals' => ['iva' => 0, 'subtotal' => 0, 'total' => 0]];
        $sales_array = [];

        $lastSale = $this->createQueryBuilder('s')->orderBy('s.billNumber', 'DESC')->setMaxResults(1)->getQuery()->getOneOrNullResult();

        if(empty($lastSale)){
            $billNumber = 1;
        }else{
            $billNumber = $lastSale->getBillNumber() + 1 ;
        }

        foreach($products as $product){
            $product_obj = $this->_em->getRepository(Product::class)->findOneBy(['sku' => $product['sku'], 'deletedAt' => null]);

            $price = $product_obj->getPrice();
            $iva = (($product_obj->getIva() * $price / 100) * $product['quantity']);
            $subtotal = ($price * $product['quantity']);
            $total = $subtotal + $iva;

            $sale_obj = new Sale();
            $sale_obj->setBillNumber($billNumber);
            $sale_obj->setProduct($product_obj);
            $sale_obj->setQuantity($product['quantity']);
            $sale_obj->setCustomer($customer['name']);
            $sale_obj->setPhone($customer['phone']);
            $sale_obj->setEmail($customer['email']);
            $sale_obj->setIva($iva);
            $sale_obj->setSubtotal($subtotal);
            $sale_obj->setTotal($total);

            $sales_array[] = $sale_obj;
        }

        $this->saveSeveral($sales_array);

        return $billNumber;
    }

    /**
     * @param $sales
     * @return bool
     */
    public function saveSeveral($sales): bool
    {
        try {
            foreach ($sales as $sale) {
                if (!$this->_em->contains($sale)) {
                    $this->_em->persist($sale);
                }
            }
            $this->_em->flush();
            return true;
        } catch (OptimisticLockException | ORMException $e) {
            return false;
        }
    }

    /**
     * @param Sale $sale
     * @return bool
     */
    public function save(Sale $sale): bool
    {
        try {
            if (!$this->_em->contains($sale)) {
                $this->_em->persist($sale);
            }
            $this->_em->flush();
            return true;
        } catch (OptimisticLockException | ORMException $e) {
            return false;
        }
    }

}