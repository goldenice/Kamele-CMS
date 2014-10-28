<?php
namespace Modules\Main\Controllers;
use \Modules\Main\System\CmsController;
use \System\Layout;
use \Exception;

if (!defined('SYSTEM')) exit('No direct script access allowed');

class Page extends CmsController {
    
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
    
    function edit($arg = null) {
        $prepend = '';
    	if ($_POST) {
    		if ($_POST['id'] == 'NEW_PAGE')
    			$ret = $this->loader['\Modules\Main\Models\Pages']->insert($_POST['title'], $_POST['body']);
    		else
    			$ret = $this->loader['\Modules\Main\Models\Pages']->updateById($_POST['id'], $_POST['title'], $_POST['body']);
    		if ($ret != false)
    			$prepend .= $this->layout->renderPart('modules/main/views/pages/messages/edit/success', array());
    		else
    			$prepend .= $this->layout->renderPart('modules/main/views/pages/messages/edit/fail', array());
    	}
    	
    	if (!is_numeric($arg[0])) {
    		$page = $this->loader['\Modules\Main\Models\Pages']->getVisibleByAlias($arg[0]);
    	}
    	else {
    		$page = $this->loader['\Modules\Main\Models\Pages']->getVisibleById($arg[0]);
    	}
    	
    	if ($page == null) {
    		$page = array(
    				'id'		=> 'NEW_PAGE',
    				'title'		=> '',
    				'body'		=> ''
    			);
    	}
    	$this->output['content'] = $this->layout->renderPart('modules/main/views/pages/edit_single', $page);
    		
    	$this->render();
    }
    
}