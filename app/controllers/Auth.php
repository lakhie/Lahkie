<?php
/**
 * Created by PhpStorm.
 * User: welcome
 * Date: 2020-07-31
 * Time: 09:17
 */

class Auth extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->model("Auth_model");
        $this->model("Ashan_model");

    }

    function index() {
        print_r($this->model);
        echo "<br/><br/>";
        $this->model->Ashan_model->Ashan();
        $this->model->Auth_model->Ashan();
        //$this->smarty->display("index.tpl");
    }
}