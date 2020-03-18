<?php
include_once("./config/routes.php");
include_once ("autoload.php");
include_once ("database.config.php");

//Loading smarty templating engine
define ("SYS_DIR", "./views/smarty-3.1.34/libs/");
//die();
require_once (SYS_DIR."Smarty.class.php");

//Database
//foreach ($database as $file_path => $db_class) {
    //include_once($file_path.".php");
    //spl_autoload_register(function($file_path){
       // include_once($file_path.".php");
    //});
    //$db_g = new $db_class;
//}


foreach ($inputs as $file_path => $input_class) {
    include_once($file_path . ".php");
}

class Controller extends Input {
    function __construct() {
        parent::__construct();
    }

    public function load_model($class) {
        $model = "";
        try {
            include_once("./models/" . $class . ".php");
            $model = new $class;
        } catch (Exception $e) {
            $this->class_load_error("Caught an exception".$e->getMessage());
        }
        return $model;
    }

    function redirect($url) {
        header("location:".$url);
        exit;
    }

    function smarty() {
        $smarty = new Smarty();
        $smarty->setTemplateDir('./views/templates')
            ->setCompileDir('./views/templates_c')
            ->setCacheDir('./views/cache');
        return $smarty;
    }

    function class_load_error($error) {
        $smarty = $this->smarty();
        $smarty->assign("error", $error);
        $smarty->display("./error/error.tpl");
    }

    function remove_none_utf_char($string) {
        $utf8 = array(
            '/[áàâãªä]/u'   =>   'a',
            '/[ÁÀÂÃÄ]/u'    =>   'A',
            '/[ÍÌÎÏ]/u'     =>   'I',
            '/[íìîï]/u'     =>   'i',
            '/[éèêë]/u'     =>   'e',
            '/[ÉÈÊË]/u'     =>   'E',
            '/[óòôõºö]/u'   =>   'o',
            '/[ÓÒÔÕÖ]/u'    =>   'O',
            '/[úùûü]/u'     =>   'u',
            '/[ÚÙÛÜ]/u'     =>   'U',
            '/ç/'           =>   'c',
            '/Ç/'           =>   'C',
            '/ñ/'           =>   'n',
            '/Ñ/'           =>   'N',
            '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
            '/[“”«»„]/u'    =>   ' ', // Double quote
            '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
        );
        return preg_replace(array_keys($utf8), array_values($utf8), $string);
    }
}

class Model {
    function __construct(){
        parent::__construct();
    }

    public function db() {
        global $database_config;
        return new MysqliDb($database_config['host'], $database_config['username'], $database_config['password'], $database_config['database']);
    }

    public function password_hash($string) {
        return hash('sha256', $string);
    }
}