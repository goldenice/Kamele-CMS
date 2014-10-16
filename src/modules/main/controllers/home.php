<?php
namespace Modules\Main\Controllers;
if (!defined('SYSTEM')) exit('No direct script access allowed');

class Home extends \System\Basecontroller {
	
	private $template;
	
	function __construct() {
		$this->template = $this->loader['\Modules\Main\Services\Templating']->getTemplateDirectory();
	}
	
    function index($arg = null) {		
        echo $this->template;
    }
}