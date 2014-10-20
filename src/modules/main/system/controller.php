<?php
namespace Modules\Main\System;
use \System\Basecontroller;
use \System\Layout;
if (!defined('SYSTEM')) exit('No direct script access allowed');

/**
 * Controller, which extends the default Kamele Framework Basecontroller
 * 
 * @package		Kamele CMS
 * @subpackage	Main
 * @author		Rick Lubbers <me@ricklubbers.nl>
 * @since		0.1
 */
class Controller extends Basecontroller {
    
    protected $layout;
	protected $output;
	protected $prevent_render = false;
	
	function __construct() {
		parent::__construct();
		
		$template = $this->loader['\Modules\Main\Services\Templating']->getTemplateDirectory();
		$template_view = $template.'/index';
		$this->layout = new Layout($template_view);
	}
	
	protected function render() {
	    if ($this->prevent_render == false) {
	        $this->layout->render($this->output);
	    }
	}
}