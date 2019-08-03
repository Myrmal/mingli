<?
include_once "app/Render.php";
$url = parse_url($_SERVER['REQUEST_URI']);

/**
 * Роут для начальной страницы
 */

if($_SERVER['REQUEST_URI'] == '/orders' || $_SERVER['REQUEST_URI'] == '/'){
    require_once "app/OrderClass.php";
    /*Если запрошен action на изменение содержимого*/
    if(isset($_POST['action']))
    {
        $function = new OrderClass();
        if($_POST['action'] == 'create')
        {
            include_once "app/SimpleCheck.php";
            $check = new SimpleCheck();
            $name = $check->filterInput($_POST['name']);
            $phone = $check->filterNumber($_POST['phone']);
            $phone = substr($phone, -10);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            echo $function->createOrder($name, $email, $phone);
        }
        if($_POST['action'] == 'delete')
        {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            echo $function->deleteOrder($id);
        }
        if($_POST['action'] == 'update')
        {
            include_once "app/SimpleCheck.php";
            $check = new SimpleCheck();
            $order_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $name = $check->filterInput($_POST['name']);
            $phone = $check->filterNumber($_POST['phone']);
            $phone = substr($phone, -10);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            if(is_int($order_id) && $check->checkTextInput($name))
            {
                echo $function->updateOrder($order_id, $name, $email, $phone);
            }
        }
    }
    /*Получаем страницу с заказами*/
    else{
        $render = new Render();
        $render->renderOrder();
    }
}

/**
 * Роут для второй страницы
 */

if($url['path'] == '/orders_details'){
    require_once 'app/OrderDetailsClass.php';
    /*Если запрошен action на изменение содержимого*/
    if(isset($_POST['action']))
    {
        $function = new OrderDetailsClass();

        if($_POST['action'] == 'create')
        {
            include_once "app/SimpleCheck.php";
            $check = new SimpleCheck();
            $product_name = $check->filterInput($_POST['name']);
            $product_price = $check->filterFloat($_POST['price']);
            $order_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            if(is_int($order_id) && is_numeric($product_price) && $check->checkTextInput($product_name))
            {
                echo $function->createOrdersDetails($order_id, $product_name, $product_price);
            }
        }
        if($_POST['action'] == 'delete')
        {
            $product_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            if(is_int($product_id))
            {
                echo $function->deleteOrdersDetails($product_id);
            }
        }
        if($_POST['action'] == 'update')
        {
            include_once "app/SimpleCheck.php";
            $check = new SimpleCheck();
            $product_name = $check->filterInput($_POST['name']);
            $product_price = $check->filterFloat($_POST['price']);
            $product_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            if(is_int($product_id) && is_numeric($product_price) && $check->checkTextInput($product_name))
            {
                echo $function->updateOrdersDetails($product_id, $product_name, $product_price);
            }
        }
    }
    /*Получаем страницу если есть id заказа*/
    elseif(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)){

        $render = new Render();
        $render->renderOrderDetails();
    }
}
?>
