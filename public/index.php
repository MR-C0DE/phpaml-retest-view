<?php

declare(strict_types=1);

$root = dirname(__DIR__);
require_once $root . '/runtime/autoload.php';

$path = (string) (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
$view = new \AML\View\FileApplication($root . '/src/views');

if ($path === '/_aml/styles.css') {
    header('Content-Type: text/css; charset=UTF-8');
    echo $view->styles();
    exit;
}

if ($path === '/api/health') {
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode(['project' => 'phpaml-retest-view', 'status' => 'ok'], JSON_THROW_ON_ERROR);
    exit;
}

try {
    $result = $view->mount($path);
    $status = 200;
} catch (OutOfBoundsException) {
    $result = $view->notFound($path);
    $status = 404;
}

http_response_code($status);
$body = $result instanceof \AML\View\PageResult ? $result->rootHtml() : (string) $result;
echo '<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>PHPAML View retest</title><link rel="stylesheet" href="/_aml/styles.css"></head><body>' . $body . '</body></html>';
