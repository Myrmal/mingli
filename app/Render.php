<?php
require_once "xtemplate/xtemplate.class.php";

/**
 * Class Render
 * Класс отображения view страниц
 */
class Render
{
    public function renderOrder()
    {
        $xtpl = new XTemplate('views/index.html');
        $xtpl->assign_file('VIEW', 'views/orders.html');
        $xtpl->assign('TITLE', 'Заказы');
        $data = new OrderClass();
        $data = $data->getOrders();
        foreach ($data as $items){
            $xtpl->assign('DATA', $items);
            $xtpl->parse('main.table.rows');
        }
        $xtpl->parse('main.table');
        $xtpl->parse('main');
        $xtpl->out('main');
    }

    public function renderOrderDetails()
    {
        $xtpl = new XTemplate('views/index.html');
        $xtpl->assign_file('VIEW', 'views/orders_details.html');
        $xtpl->assign('TITLE', 'Подробности заказа');
        $xtpl->assign('ORDER_ID', $_GET['id']);
        $data = new OrderDetailsClass();
        $data = $data->getOrdersDetails($_GET['id']);
        foreach ($data as $items){
            $xtpl->assign('DATA', $items);
            $xtpl->parse('main.table.rows');
        }
        $xtpl->parse('main.table');
        $xtpl->parse('main');
        $xtpl->out('main');
    }
}