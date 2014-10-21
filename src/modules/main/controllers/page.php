<?php
namespace Modules\Main\Controllers;
use \Modules\Main\System\Controller;
use \System\Layout;
use \Exception;

if (!defined('SYSTEM')) exit('No direct script access allowed');

class Page extends Controller {
    
    function view($arg = null) {
        if (!is_numeric($arg[0]))
            $page = $this->loader['\Modules\Main\Models\Pages']->getVisibleByAlias($arg[0]);
        else
            $page = $this->loader['\Modules\Main\Models\Pages']->getVisibleById($arg[0]);
        
        if ($page == null) {
            // TODO: implement 404
        }
        else
            $this->output['content'] = $this->layout->renderPart('modules/main/views/pages/single', $page);
        
        $this->render();
    }
    
}