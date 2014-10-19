<?php
namespace Modules\Main\Models;
use	\System\Baseservice;

if (!defined('SYSTEM')) exit('No direct script access allowed');

/**
 * Articles model
 * 
 * @package		Kamele CMS
 * @subpackage	Main
 * @author		Rick Lubbers <me@ricklubbers.nl>
 * @since		0.1
 */
class Articles extends Baseservice {
    
    public function getById($id) {
	    $article = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `articles` WHERE `id`=:id LIMIT 0,1", array('id'=>$id)));
	    if ($article != null && is_array($article)) {
	        return $article;
	    }
	    return null;
	}
	
	public function getVisibleById($id) {
	    $cur_time = time();
	    $article = $this->db->fetchAssoc($this->db->safeQuery(
	        "SELECT * FROM `articles` WHERE `id`=:id AND `publish_from`<=:time AND `publish_to`>=:time AND `hidden`=0 LIMIT 0,1"
	        ),
	        array(
	            'id'    => $id,
	            'time'  => $cur_time   
	            ));
        if ($article != null && is_array($article)) {
            return $article;
        }
        return null;
	}
	
	public function getByAlias($alias) {
	    $article = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `articles` WHERE `alias`=:alias LIMIT 0,1", array('alias'=>$alias)));
	    if ($page != null && is_array($article)) {
	        return $article;
	    }
	    return null;
	}
	
	public function getVisibleByAlias($alias) {
	    $cur_time = time();
	    $article = $this->db->fetchAssoc($this->db->safeQuery(
	        "SELECT * FROM `articles` WHERE `alias`=:alias AND `publish_from`<=:time AND `publish_to`>=:time AND `hidden`=0 LIMIT 0,1"
	        ), array(
	            'alias' => $alias,
	            'time'  => $cur_time
	            ));
	    if ($article != null && is_array($article)) {
	        return $article;
	    }
	    return null;
	}
}