<?php
namespace Modules\Main\Controllers;
if (!defined('SYSTEM')) exit('No direct script access allowed');

class Home extends \System\Basecontroller {
    function index($arg = null) {		
        $layout = new \System\Layout('modules/main/views/home');

        
        $layout->render(array('content'=>$content, 'title'=>'Home'));
    }
}