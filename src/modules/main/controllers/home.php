<?php
namespace Modules\Main\Controllers;
use \Modules\Main\System\Controller;
use \System\Layout;
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
        $this->output['content'] = 'Test';
    }
	
}