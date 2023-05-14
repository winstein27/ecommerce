<?php

include_once "../App/Models/Product.php";

use App\Core\Database;

class Dvd extends Product
{
    public function addProduct()
    {
        $sql = 'INSERT INTO product (sku, name, price, type, size)
        VALUES (?, ?, ?, ?, ?)';

        $conn = Database::getConn();

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(1, $this->getSku());
        $stmt->bindValue(2, $this->getName());
        $stmt->bindValue(3, $this->getPrice());
        $stmt->bindValue(4, $this->getType());
        $stmt->bindValue(5, $this->getAttribute('size'));

        $stmt->execute();
        return $conn->lastInsertId();
    }
}
