<?php

namespace App;

use App\Database\Mysql;

class Application
{
    public function execute(): void
    {
        $conn = Mysql::instance();
        $products = $this->getAllProducts($conn);
        echo json_encode($products) . "\n";
    }

    private function getAllProducts(Mysql $conn): array
    {

        $sql = 'SELECT * FROM products WHERE id > :id';
        $stmt = $conn->prepare($sql, [Mysql::ATTR_CURSOR => Mysql::CURSOR_FWDONLY]);
        $stmt->execute(['id' => 1]);
        $rows = $stmt->fetchAll(Mysql::FETCH_ASSOC);

        return $rows;
    }
}
