<?php
namespace Modules\Main\System;
use \System\Basecontroller;
use \System\Layout;
use \System\Router;
if (!defined('SYSTEM')) exit('No direct script access allowed');

/**
 * Controller, which extends the default Kamele Framework Basecontroller
 * 
 * @package		Kamele CMS
 * @subpackage	Main
 * @author		Rick Lubbers <me@ricklubbers.nl>
 * @since		0.1
 */
class CmsController extends Basecontroller {
    
    protected $layout;
	protected $output;
	protected $prevent_render = false;
	
	function __construct() {
		parent::__construct();
		
		$template = $this->loader['\Modules\Main\Services\Templating']->getTemplateDirectory();
		$template_view = $template.'/index';
		$this->layout = new Layout($template_view);
		
		$this->output['system:head'] = $this->layout->renderPart('modules/main/views/system/head', array());
	}
	
	protected function render() {
	    if ($this->prevent_render == false) {
	        $this->layout->render($this->output);
	    }
	}
	
	protected function forceLogin() {
	    if ($this->loader['\Modules\Main\Services\Auth']->isLoggedIn() != true) {
	        Router::redirect('main/user/login');
	        return false;
	    }
        return true;
	}
}