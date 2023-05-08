<?php
class ProductController {
    public function __construct(private ProductGateway $gateway)
    {
    }

    public function processRequest(string $method):void
    {
        if($method == "GET") {
            echo json_encode($this->gateway->getAll());
        } elseif ($method == "POST") {
            echo "add new";
        } else {
            http_response_code(405);
            header("Allow: GET, POST");
        }
    }
}
