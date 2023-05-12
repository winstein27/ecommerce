<?php

use App\Core\Controller;

class Products extends Controller
{
    public function index()
    {
        $productModel = $this->createModel("Product");

        $products = $productModel->getAll();
        if (!$products) {
            http_response_code(204);
            exit;
        }

        echo json_encode($products, JSON_UNESCAPED_UNICODE);
    }

    public function store()
    {
        $product = $this->getRequestBody();
        // $productModel = $this->model("Product");

        $errors = $this->getAddProductValidationErrors($product);

        if (!empty($errors)) {
            http_response_code(422);
            echo json_encode((["errors" => $errors]));
            return;
        }

        // $checkSku = $productModel->findBySku($body->sku);

        // if ($checkSku) {
        //     http_response_code(400);
        //     echo json_encode(["Error" => "Product already registered"]);
        //     exit;
        // }

        echo $product["type"];
        $modelByType = $this->createModel("Book");

        echo $modelByType;

        $modelByType->setSku($product["sku"]);
        $modelByType->setName($product["name"]);
        $modelByType->setPrice(floatval($product["price"]));
        $modelByType->setType($product["type"]);
        $modelByType->setAttributes($product);


        $addedProduct = $modelByType->addProduct();



        if ($modelByType) {
            http_response_code(201);
            echo json_encode($addedProduct);
            return;
        };
    }

    // public function deleteMany()
    // {
    //     $body = $this->getRequestBody();
    //     $productModel = $this->model("Product");

    //     if (count($body->ids) === 0) {
    //         http_response_code(400);
    //         echo json_encode(["Error" => "No product selected"]);
    //         return;
    //     }

    //     foreach ($body->ids as $id) {
    //         $checkProduct = $productModel->findById($id);
    //         if ($checkProduct) {
    //             $productModel->delete($id);
    //         }
    //     }
    //     http_response_code(204);
    //     echo json_encode(["Success" => "Products deleted"]);
    // }

    private function getAddProductValidationErrors($data)
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
