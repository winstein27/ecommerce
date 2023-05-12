<?php

use App\Core\Database;

class Book extends Product
{
    public function addProduct(): Product
    {
        $sql = 'INSERT INTO product (sku, name, price, type, weight)
        VALUES (?, ?, ?, ?, ?)';

        $stmt = Database::getConn()->prepare($sql);

        $stmt->bindValue(1, $this->getSku());
        $stmt->bindValue(2, $this->getName());
        $stmt->bindValue(3, $this->getPrice());
        $stmt->bindValue(4, $this->getType());
        $stmt->bindValue(5, $this->getAttribute('weight'));

        if ($stmt->execute()) {
            return $this;
        }
        return null;
    }
}
