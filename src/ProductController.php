<?php
class ProductController {
    public function processRequest(string $method): void {
        if($method == "GET") {
            echo "get list";
        } elseif ($method == "POST") {
            echo "add new";
        } else {
            http_response_code(405);
            header("Allow: GET, POST");
        }
    }
}
