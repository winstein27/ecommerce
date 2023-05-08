<?php

class ProductGateway
{
    private PDO $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM product ORDER BY id";

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $product): string
    {
        $sql = "INSERT INTO product (sku, name, price, type, weight, size, height, width, length)
                VALUES (:sku, :name, :price, :type, :weight, :size, :height, :width, :length)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":sku", $product["sku"], PDO::PARAM_STR);
        $stmt->bindValue(":name", $product["name"], PDO::PARAM_STR);
        $stmt->bindValue(":price", $product["price"], PDO::PARAM_INT);
        $stmt->bindValue(":type", $product["type"], PDO::PARAM_STR);

        if ($product["type"] == "book") {
            $stmt->bindValue(":weight", $product["weight"], PDO::PARAM_INT);
            $stmt->bindValue(":size", null, PDO::PARAM_NULL);
            $stmt->bindValue(":height", null, PDO::PARAM_NULL);
            $stmt->bindValue(":width", null, PDO::PARAM_NULL);
            $stmt->bindValue(":length", null, PDO::PARAM_NULL);
        } elseif ($product["type"] == "dvd") {
            $stmt->bindValue(":weight", null, PDO::PARAM_NULL);
            $stmt->bindValue(":size", $product["size"], PDO::PARAM_INT);
            $stmt->bindValue(":height", null, PDO::PARAM_NULL);
            $stmt->bindValue(":width", null, PDO::PARAM_NULL);
            $stmt->bindValue(":length", null, PDO::PARAM_NULL);
        } elseif ($product["type"] == "furniture") {
            $stmt->bindValue(":weight", null, PDO::PARAM_NULL);
            $stmt->bindValue(":size", null, PDO::PARAM_NULL);
            $stmt->bindValue(":height", $product["height"], PDO::PARAM_INT);
            $stmt->bindValue(":width", $product["width"], PDO::PARAM_INT);
            $stmt->bindValue(":length", $product["length"], PDO::PARAM_INT);
        }

        $stmt->execute();

        return $this->conn->lastInsertId();
    }
}
