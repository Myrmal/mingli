<?php

/**
 * Class SimpleCheck
 * Класс проверки и фильтрации некоторых вводимых данных
 */
class SimpleCheck
{
    /**
     * @param $data
     * @return string
     */
    public function filterInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * @param $data (текстовые данные)
     * @return bool
     */
    public function checkTextInput($data)
    {
        if(preg_match("/[^\d\w\s-]+/u", $data) == 0){
            return true;
        }
        return false;
    }

    /**
     * @param $data (цена)
     * @return mixed
     */
    public function filterFloat($data)
    {
        return str_replace(",", ".", $data);
    }

    /**
     * @param $data (номер телефона)
     * @return mixed
     */
    public function filterNumber($data)
    {
        return preg_replace("/[^0-9]/", '', $data);
    }
}