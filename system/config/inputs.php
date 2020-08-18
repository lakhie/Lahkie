<?php
class Input {
    function __construct()
    {

    }

    function post($string = '') {
        $string = trim($string);
        if (empty($string))
            return $_POST;
        if (isset($_POST[$string]))
            return $_POST[$string];
        else
            return false;
    }

    function get($string = '') {
        $string = trim($string);
        if (empty($string))
            return $_GET;
        if (isset($_GET[$string]))
            return $_GET[$string];
        else
            return false;
    }
}

class Mail {
    function __construct()
    {
    }

    function mail($to, $subject, $from, $message) {
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

class Cookies  {
    public $cookie;
    function __construct()
    {
        //parent::__construct();
        $this->cookie = $this->get_cookie();
    }

    function get_cookie() {
        return $_COOKIE;
    }
    function set($cookie_name, $cookie_data) {
        setcookie($cookie_name, $cookie_data, time() + (86400 * 30 * 3), "/");
    }

    function read($cookie_name = false) {
        if (isset($cookie_name))
            if (isset($_COOKIE[$cookie_name]))
                return $_COOKIE[$cookie_name];
            else
                return false;
        return $_COOKIE;

    }

    function destroy($cookie) {
        setcookie( $cookie, "", time()- 60, "/","", 0);
    }
}

class Session {
    public $session_data;
    function __construct()
    {
        $this->session_data = $this->session_data();
    }

    function session_data() {
        return json_decode(json_encode(array()));
    }

    function set_user_data($session, $data) {
        $_SESSION[$session] = $data;
    }

    function data($session) {
        if (empty(trim($session)))
            return $_SESSION;
        if (isset ($_SESSION[$session]))
            return $_SESSION[$session];
        else
            return false;
    }

    function remove_data($session) {
        if (isset($_SESSION[$session]))
            unset($_SESSION[$session]);
        return true;
    }

    function destroy() {
        session_unset();
        session_destroy();
    }
}


class Server {
    function __construct()
    {
    }
    function request_method() {
        return $_SERVER['REQUEST_METHOD'];
    }

    function query_string() {
        return $_SERVER['QUERY_STRING'];
    }

    function request_uri() {
        return $_SERVER['REQUEST_URI'];
    }

    function document_root() {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    function server_name() {
        return $_SERVER['SERVER_NAME'];
    }

    function http_referer() {
        if (isset($_SERVER['HTTP_REFERER']))
            return $_SERVER['HTTP_REFERER'];
        else return $this->server_name();
    }

    function addr() {
        return $_SERVER['SERVER_ADDR'];
    }

    function remote_addr() {
        return $_SERVER['REMOTE_ADDR'];
    }
}