<?php

header("Content-Type: application/json");

require '../vendor/autoload.php';

use App\Models\Categories;
use App\Repository\CategoriesRepository;
use App\Util\Pagination;

$repository = new CategoriesRepository();

header("Content-Type: application/json");
$method = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$id = $uri[count($uri) - 1];

switch ($method) {
    case 'GET':
        if (is_numeric($id)) {
            $result = $repository->read((int) $id);
            echo json_encode($result ? $result->toArray() : null);
        } else {
            $page = $_GET['page'] ?? 1;
            $limit = $_GET['limit'] ?? 10;
            $pagination = new Pagination((int) $page, (int) $limit);
            $results = $repository->list($pagination);
            echo json_encode(array_map(fn($result) => $result->toArray(), $results));
        }
        break;
    case 'POST':
        $input = file_get_contents('php://input');
        $model = new Categories();
        $model->setFromJson($input);
        $id = $repository->create($model);
        echo json_encode(['id' => $id]);
        break;
    case 'PUT':
        if (is_numeric($id)) {
            $input = file_get_contents('php://input');
            $model = new Categories();
            $model->setFromJson($input);
            $model->setId((int) $id);
            $count = $repository->update($model);
            echo json_encode(['count' => $count]);
        }
        break;
    case 'DELETE':
        if (is_numeric($id)) {
            $count = $repository->delete((int) $id);
            echo json_encode(['count' => $count]);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Method not allowed']);
        break;
}
