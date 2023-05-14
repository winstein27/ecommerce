<?php

use App\Core\Database;

class Product
{
    private string $sku;
    private string $name;
    private float $price;
    private string $type;
    private object $attributes;

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setAttributes(object $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function getAttribute($attribute): float
    {
        return $this->attributes->$attribute;
    }

    public function getAllAttributes(): object
    {
        return $this->attributes;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM product ORDER BY id";

        $stmt = Database::getConn()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $products = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $products;
        } else {
            return [];
        }
    }

    public function findBySku(string $sku)
    {
        $sql = "SELECT * FROM product WHERE sku=?";

        $stmt = Database::getConn()->prepare($sql);
        $stmt->bindValue(1, $sku);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $product = $stmt->fetchAll(PDO::FETCH_OBJ)[0];

            return $product;
        }

        return null;
    }

    public function massDelete(array $ids): void
    {
        $sql = "DELETE FROM product WHERE id IN ?";

        $stmt = Database::getConn()->prepare($sql);
        $stmt->bindValue(1, $ids);
        $stmt->execute();
    }
}
