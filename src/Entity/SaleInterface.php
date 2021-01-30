<?php

declare(strict_types=1);

namespace App\Entity;

interface SaleInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     */
    public function setId(int $id): void;

    /**
     * @return string
     */
    public function getBillNumber(): string;

    /**
     * @param string $billNumber
     */
    public function setBillNumber(string $billNumber): void;

    /**
     * @return Product
     */
    public function getProduct(): Product;

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void;

    /**
     * @return int
     */
    public function getQuantity(): int;

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void;

    /**
     * @return string
     */
    public function getCustomer(): string;

    /**
     * @param string $customer
     */
    public function setCustomer(string $customer): void;

    /**
     * @return string|null
     */
    public function getPhone(): ?string;

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void;

    /**
     * @return string|null
     */
    public function getEmail(): ?string;

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void;

    /**
     * @return float
     */
    public function getSubtotal(): float;

    /**
     * @param float $subtotal
     */
    public function setSubtotal(float $subtotal): void;

    /**
     * @return float
     */
    public function getIva(): float;

    /**
     * @param float $iva
     */
    public function setIva(float $iva): void;

    /**
     * @return float
     */
    public function getTotal(): float;

    /**
     * @param float $total
     */
    public function setTotal(float $total): void;
}