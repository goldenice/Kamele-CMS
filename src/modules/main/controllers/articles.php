<?php
namespace Modules\Main\Controllers;
use \Modules\Main\System\CmsController;
use \System\Layout;
use \Exception;

if (!defined('SYSTEM')) exit('No direct script access allowed');

class Articles extends CmsController {
    
    function latest($arg = null) {
        $page = $arg[0];
        if (!isset($arg[0]) or is_nan($arg[0])) {
            $page = 1;
        }
        
        $articles = $this->loader['\Modules\Main\Services\Articles']->getLatest($page);
        
        $content = '';
        if ($articles != null) {
            foreach ($articles as $key=>$article) {
                $content .= $this->layout->renderPart('modules/main/views/articles/list/item', $article);
            }
        }
        $content = $this->layout->renderPart('modules/main/views/articles/list/wrapper', array('columns'=>$content));
        
        $this->output['title'] = 'Articles';
        $this->output['content'] = $content;
        
        $this->render();
    }
    
    function view($arg = null) {
    	if (!is_numeric($arg[0]))
            $page = $this->loader['\Modules\Main\Models\Articles']->getVisibleByAlias($arg[0]);
        else
            $page = $this->loader['\Modules\Main\Models\Articles']->getVisibleById($arg[0]);
        
        if ($page == null) {
            // TODO: implement 404
        }
        else
            $this->output['content'] = $this->layout->renderPart('modules/main/views/articles/single', $page);
        
        $this->render();
    }
    
    function edit($arg = null) {
    	$prepend = '';
    	if ($_POST) {
    		if ($_POST['id'] == 'NEW_ARTICLE')
    			$ret = $this->loader['\Modules\Main\Models\Articles']->insert($_POST['title'], $_POST['body']);
    		else
    			$ret = $this->loader['\Modules\Main\Models\Articles']->updateById($_POST['id'], $_POST['title'], $_POST['body']);
    		if ($ret != false)
    			$prepend .= $this->layout->renderPart('modules/main/views/articles/messages/edit/success', array());
    		else
    			$prepend .= $this->layout->renderPart('modules/main/views/articles/messages/edit/fail', array());
    	}
    	
    	if (!is_numeric($arg[0])) {
    		$page = $this->loader['\Modules\Main\Models\Articles']->getVisibleByAlias($arg[0]);
    	}
    	else {
    		$page = $this->loader['\Modules\Main\Models\Articles']->getVisibleById($arg[0]);
    	}
    	
    	if ($page == null) {
    		$page = array(
    				'id'		=> 'NEW_ARTICLE',
    				'title'		=> '',
    				'body'		=> ''
    			);
    	}
    	$this->output['content'] = $this->layout->renderPart('modules/main/views/articles/edit_single', $page);
    		
    	$this->render();
    }
    
}