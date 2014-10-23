<?php
namespace Modules\Main\Controllers;
use \Modules\Main\System\Controller;
use \System\Layout;
use \Exception;

if (!defined('SYSTEM')) exit('No direct script access allowed');

class Articles extends Controller {
    
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
        
        $this->output['title'] = 'Articles';
        $this->output['content'] = $content;
        
        $this->render();
    }
    
    function view() {
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
    
}