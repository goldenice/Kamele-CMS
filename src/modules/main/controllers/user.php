<?php
namespace Modules\Main\Controllers;
use \Modules\Main\System\Cmscontroller;
use \System\Layout;
use \Exception;

if (!defined('SYSTEM')) exit('No direct script access allowed');

/**
 * User controller
 * For logins
 * 
 * @package		Kamele CMS
 * @subpackage	Main
 * @author 		Rick Lubbers <me@ricklubbers.nl>
 * @since 		0.1
 */
class User extends Cmscontroller {
	
	public function login($arg = null) {
		if ($this->loader['\Modules\Main\Services\Auth']->isLoggedIn()) \System\Router::redirect('');
		
		if ($_POST) {
			$result = $this->loader['\Modules\Main\Services\Auth']->login($_POST['email'], $_POST['password']);
			if ($result === true) {
			    \System\Router::redirect('');
			}
			else {
			    // TODO: implement error message
			}
		}
		
		$this->output['title'] = 'Login';
		$this->output['content'] = $this->layout->renderPart('modules/main/views/user/forms/login', array());
		$this->render();
	}
	
}