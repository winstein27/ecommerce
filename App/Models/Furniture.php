<?php

include_once "../App/Models/Product.php";

use App\Core\Database;

class Furniture extends Product
{
    public function addProduct()
    {
        $sql = "INSERT INTO product (sku, name, price, type, height, width, length)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $conn = Database::getConn();

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(1, $this->getSku());
        $stmt->bindValue(2, $this->getName());
        $stmt->bindValue(3, $this->getPrice());
        $stmt->bindValue(4, $this->getType());
        $stmt->bindValue(5, $this->getAttribute('height'));
        $stmt->bindValue(6, $this->getAttribute('width'));
        $stmt->bindValue(7, $this->getAttribute('length'));

        $stmt->execute();
        return $conn->lastInsertId();
    }
}
