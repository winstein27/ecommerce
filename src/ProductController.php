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

            $errors = $this->getValidationErrors($product);

            if (!empty($errors)) {
                http_response_code(422);
                echo json_encode((["errors" => $errors]));
                return;
            }

            $id = $this->gateway->create($product);
            http_response_code(201);
            echo json_encode(["message" => "Product added.", "id" => $id]);
        } else {
            http_response_code(405);
            header("Allow: GET, POST");
        }
    }

    private function getValidationErrors(array $data): array
    {
        $errors = [];

        if (empty($data["sku"])) {
            $errors[] = "SKU is required.";
        }

        if (empty($data["name"])) {
            $errors[] = "Name is required.";
        }

        if (empty($data["price"])) {
            $errors[] = "Price is required.";
        } else {
            if (filter_var($data["price"], FILTER_VALIDATE_FLOAT) == false) {
                $errors[] = "Price must be a number.";
            }
        }

        if (empty($data["type"])) {
            $errors[] = "Type is required.";
        } else {
            if ($data["type"] == "book") {
                if (empty($data["weight"])) {
                    $errors[] = "Weight is required for books.";
                } else if (filter_var($data["weight"], FILTER_VALIDATE_FLOAT) == false) {
                    $errors[] = "Weight must be a number.";
                }
            }

            if ($data["type"] == "dvd") {
                if (empty($data["size"])) {
                    $errors[] = "Size is required for DVDs.";
                } else if (filter_var($data["size"], FILTER_VALIDATE_FLOAT) == false) {
                    $errors[] = "Size must be a number.";
                }
            }

            if ($data["type"] == "furniture") {
                if (empty($data["height"])) {
                    $errors[] = "Height is required for fornitures.";
                } else if (filter_var($data["height"], FILTER_VALIDATE_FLOAT) == false) {
                    $errors[] = "Height must be a number.";
                }

                if (empty($data["width"])) {
                    $errors[] = "Width is required for fornitures.";
                } else if (filter_var($data["width"], FILTER_VALIDATE_FLOAT) == false) {
                    $errors[] = "Width must be a number.";
                }

                if (empty($data["length"])) {
                    $errors[] = "Length is required for fornitures.";
                } else if (filter_var($data["length"], FILTER_VALIDATE_FLOAT) == false) {
                    $errors[] = "Length must be a number.";
                }
            }
        }

        return $errors;
    }
}
