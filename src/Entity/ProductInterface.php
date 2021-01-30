<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;

interface ProductInterface
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
    public function getSku(): string;

    /**
     * @param string $sku
     */
    public function setSku(string $sku): void;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @param float $price
     */
    public function setPrice(float $price): void;

    /**
     * @return float
     */
    public function getIva(): float;

    /**
     * @param float $iva
     */
    public function setIva(float $iva): void;

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime;

    /**
     * @param DateTime|null $deletedAt
     */
    public function setDeletedAt(?DateTime $deletedAt): void;

}