<?php
require_once "ConnectionDB.php";

/**
 * Class OrderDetailsClass
 * Класс работы с БД страницы деталей заказов
 */

class OrderDetailsClass
{
    /**
     * @return ConnectionDB
     */
    private function db()
    {
        return new ConnectionDB();
    }

    /**
     * @param $id
     * @return array
     */
    public function getOrdersDetails($id)
    {
        $db = $this->db()->connectionMysql();
        $stmt = $db->prepare('SELECT * FROM orders_details WHERE order_id=?');
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * @param $order_id
     * @param $product_name
     * @param $product_price
     * @return string
     */
    public function createOrdersDetails($order_id, $product_name, $product_price)
    {
        $db = $this->db()->connectionMysql();
        $stmt = $db->prepare('INSERT INTO orders_details (order_id, product_name, product_price) VALUES (?,?,?)');
        $stmt->bindparam(1, $order_id);
        $stmt->bindParam(2, $product_name);
        $stmt->bindParam(3, $product_price);
        $stmt->execute();
        $lastid = $db->lastInsertId();
        return json_encode(['id' => $lastid, 'name' => $product_name, 'price' =>$product_price]);
    }

    /**
     * @param $order_id
     * @return bool
     */
    public function deleteOrdersDetails($order_id)
    {
        $db = $this->db()->connectionMysql();
        $stmt = $db->prepare("DELETE FROM orders_details WHERE id = ?");
        $stmt->bindparam(1, $order_id);
        $stmt->execute();
        return true;
    }

    /**
     * @param $product_id
     * @param $product_name
     * @param $product_price
     * @return string
     */
    public function updateOrdersDetails($product_id, $product_name, $product_price)
    {
        $db = $this->db()->connectionMysql();
        $stmt = $db->prepare('UPDATE orders_details SET product_name=?, product_price=? WHERE id=?');
        $stmt->bindParam(1, $product_name);
        $stmt->bindParam(2, $product_price);
        $stmt->bindParam(3, $product_id);
        $stmt->execute();
        return json_encode(['id' => $product_id, 'name' => $product_name, 'price' =>$product_price]);
    }
}