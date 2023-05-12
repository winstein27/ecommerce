<?php

use App\Core\Database;

class DVD extends Product
{
    public function addProduct(): Product
    {
        $sql = 'INSERT INTO products (sku, name, price, type, size)
        VALUES (?, ?, ?, ?, ?)';

        $stmt = Database::getConn()->prepare($sql);

        $stmt->bindValue(1, $this->getSku());
        $stmt->bindValue(2, $this->getName());
        $stmt->bindValue(3, $this->getPrice());
        $stmt->bindValue(4, $this->getType());
        $stmt->bindValue(5, $this->getAttribute('size'));

        if ($stmt->execute()) {
            return $this;
        }
        return null;
    }
}
