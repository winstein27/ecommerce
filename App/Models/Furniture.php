<?php

use App\Core\Database;

class Furniture extends Product
{
    public function addProduct(): Product
    {
        $sql = "INSERT INTO product (sku, name, price, type, height, width, length)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = Database::getConn()->prepare($sql);

        $stmt->bindValue(1, $this->getSku());
        $stmt->bindValue(2, $this->getName());
        $stmt->bindValue(3, $this->getPrice());
        $stmt->bindValue(4, $this->getType());
        $stmt->bindValue(5, $this->getAttribute('height'));
        $stmt->bindValue(6, $this->getAttribute('width'));
        $stmt->bindValue(7, $this->getAttribute('length'));

        if ($stmt->execute()) {
            return $this;
        }
        return null;
    }
}
