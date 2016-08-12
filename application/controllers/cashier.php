<?php
require_once ("secure_area.php");
class Cashier extends Secure_area
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->load->view("cashier/cashier");
    }

    function logout()
    {
        $this->Employee->logout();
    }
}
?>