<?php
require_once "ConnectionDB.php";

/**
 * Class OrderClass
 * Класс работы с БД страницы заказов
 */

class OrderClass
{
    /**
     * @return ConnectionDB
     */
    private function db()
    {
        return new ConnectionDB();
    }

    /**
     * @return array
     */
    public function getOrders()
    {
        $db = $this->db()->connectionMysql();
        $stmt = $db->prepare('SELECT * FROM orders');
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * @param $name
     * @param $email
     * @param $phone
     * @return string
     */
    public function createOrder($name, $email, $phone)
    {
        $db = $this->db()->connectionMysql();
        $stmt = $db->prepare('INSERT INTO orders (name, email, phone_number) VALUES (?,?,?)');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $phone);
        $stmt->execute();
        $id = $db->lastInsertId();
        return json_encode(['id' => $id, 'name' => $name, 'email' =>$email, 'phone' => $phone]);
    }

    /**
     * @param $id
     * @param $name
     * @param $email
     * @param $phone
     * @return string
     */
    public function updateOrder($id, $name, $email, $phone)
    {
        $db = $this->db()->connectionMysql();
        $stmt = $db->prepare('UPDATE orders SET name=?, email=?, phone_number=? WHERE id=?');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $phone);
        $stmt->bindParam(4, $id);
        $stmt->execute();
        return json_encode(['id' => $id, 'name' => $name, 'email' =>$email, 'phone' => $phone]);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteOrder($id)
    {
        $db = $this->db()->connectionMysql();
        $stmt = $db->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $stmt = $db->prepare("DELETE FROM orders_details WHERE order_id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return true;
    }
}