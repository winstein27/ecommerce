<?php
class ProductController
{
    public function __construct(private ProductGateway $gateway)
    {
    }

    public function processRequest(string $method): void
    {
        if ($method == "GET") {
            echo json_encode($this->gateway->getAll());
        } elseif ($method == "POST") {
            $product = (array) json_decode(file_get_contents("php://input"), true);

            $id = $this->gateway->create($product);
            http_response_code(201);
            echo json_encode(["message" => "Product added.", "id" => $id]);
        } else {
            http_response_code(405);
            header("Allow: GET, POST");
        }
    }
}
