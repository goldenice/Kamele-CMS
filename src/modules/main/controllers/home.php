<?php
namespace Modules\Main\Controllers;
use \Modules\Main\System\Controller;
use \System\Layout;
use \Exception;

if (!defined('SYSTEM')) exit('No direct script access allowed');

/**
 * Home controller
 * 
 * @package		Kamele CMS
 * @subpackage	Main
 * @author		Rick Lubbers <me@ricklubbers.nl>
 * @since		0.1
 */
class Home extends Controller {
	
	function index($arg = null) {
		// Get whether the home page is a blog article overview or a static page
		$fp_type = $this->loader['\Modules\Main\Models\Settings']->getKey('frontpage_type');
		
		if ($fp_type == 'static') {
			$fp_id = $this->loader['\Modules\Main\Models\Settings']->getKey('frontpage_page_id');
			if ($fp_id == null || is_nan($fp_id)) {
				throw new Exception("Front page id setting not defined correctly");
			}
			else {
				$this->loader['\Modules\Main\Controllers\Page']->view(array($fp_id));
				$this->layout = null;
				$this->prevent_render = true;
			}
		}
		elseif ($fp_type == 'articles') {
			$this->loader['\Modules\Main\Controllers\Articles']->latest();
			$this->prevent_render = true;
		}
		else {
			throw new Exception("Front page type setting not defined correctly");
		}
		
        $this->output['content'] = 'Test';
        
        $this->render();
    }
    
}