<?php
class Input extends Server {
    function __construct()
    {
        parent::__construct();
    }

    function input_post($string = '') {
        $string = trim($string);
        if (empty($string))
            return $_POST;
        if (isset($_POST[$string]))
            return $_POST[$string];
        else
            return false;
    }

    function input_get($string = '') {
        $string = trim($string);
        if (empty($string))
            return $_GET;
        if (isset($_GET[$string]))
            return $_GET[$string];
        else
            return false;
    }

    function send_mail($to, $subject, $from, $message) {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From:". $from . "\r\n";
        try {
            mail($to,$subject,$message,$headers);
        }
        catch(Exception $e){

        };
    }
}

class Session {
    function __construct()
    {
    }

    function sess_setuserdata($session, $data) {
        $_SESSION[$session] = $data;
    }

    function sess_data($session) {
        if (empty(trim($session)))
            return $_SESSION;
        if (isset ($_SESSION[$session]))
            return $_SESSION[$session];
        else
            return false;
    }

    function sess_removedata($session) {
        if (isset($_SESSION[$session]))
            unset($_SESSION[$session]);
        return true;
    }

    function sess_destroy() {
        session_unset();
        session_destroy();
    }
}

class Server extends Session {
    function __construct()
    {
    }
    function server_request_method() {
        return $_SERVER['REQUEST_METHOD'];
    }

    function server_query_string() {
        return $_SERVER['QUERY_STRING'];
    }

    function server_request_uri() {
        return $_SERVER['REQUEST_URI'];
    }

    function server_document_root() {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    function server_name() {
        return $_SERVER['SERVER_NAME'];
    }

    function server_addr() {
        return $_SERVER['SERVER_ADDR'];
    }

    function server_remote_addr() {
        return $_SERVER['REMOTE_ADDR'];
    }
}