<?php

class ErrorHandler
{
    public static function handleError(int $errNo, string $errStr, string $errFile, int $errLine): void
    {
        throw new ErrorException($errStr, 0, $errNo, $errFile, $errLine);
    }

    public static function handleException(Throwable $exception): void
    {
        http_response_code(505);
        echo json_encode([
            "code" => $exception->getCode(),
            "message" => $exception->getMessage(),
            "file" => $exception->getFile(),
            "line" => $exception->getLine()
        ]);
    }
}
