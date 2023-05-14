<?php

use App\Core\Database;

include_once "../App/Models/Product.php";

class Book extends Product
{
    public function addProduct()
    {
        $sql = 'INSERT INTO product (sku, name, price, type, weight)
        VALUES (?, ?, ?, ?, ?)';

        $conn = Database::getConn();

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(1, $this->getSku());
        $stmt->bindValue(2, $this->getName());
        $stmt->bindValue(3, $this->getPrice());
        $stmt->bindValue(4, $this->getType());
        $stmt->bindValue(5, $this->getAttribute('weight'));

        $stmt->execute();
        return $conn->lastInsertId();
    }
}
