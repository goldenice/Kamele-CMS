<?php
namespace Modules\Main\Controllers;
if (!defined('SYSTEM')) exit('No direct script access allowed');

/**
 * Home controller
 * 
 * @package		Kamele CMS
 * @subpackage	Main
 * @author		Rick Lubbers <me@ricklubbers.nl>
 * @since		0.1
 */
class Home extends \System\Basecontroller {
	
	private $template;
	
	function __construct() {
		parent::__construct();
		
		$this->template = $this->loader['\Modules\Main\Services\Templating']->getTemplateDirectory();
	}
	
    function index($arg = null) {		
        echo $this->template;
    }
}