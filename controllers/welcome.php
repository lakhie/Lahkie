<?php
defined('LAHKIEPATH') OR exit('No direct script access allowed');
class Welcome extends Controller {
	function __construct() {
		
	}
	
	function index() {
		$smarty = $this->smarty();
		$smarty->display("welcome.tpl");
	}
}