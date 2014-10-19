<?php
namespace Modules\Main\Models;
use	\System\Baseservice;

if (!defined('SYSTEM')) exit('No direct script access allowed');

/**
 * Pages model
 * 
 * @package		Kamele CMS
 * @subpackage	Main
 * @author		Rick Lubbers <me@ricklubbers.nl>
 * @since		0.1
 */
class Pages extends Baseservice {
	
	public function getById($id) {
	    $page = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `pages` WHERE `id`=:id LIMIT 0,1", array('id'=>$id)));
	    if ($page != null && is_array($page)) {
	        return $page;
	    }
	    return null;
	}
	
	public function getVisibleById($id) {
	    $page = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `pages` WHERE `id`=:id AND `hidden`=0 LIMIT 0,1", array('id' => $id)));
        if ($page != null && is_array($page)) {
            return $page;
        }
        return null;
	}
	
	public function getByAlias($alias) {
	    $page = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `pages` WHERE `alias`=:alias LIMIT 0,1", array('alias'=>$alias)));
	    if ($page != null && is_array($page)) {
	        return $page;
	    }
	    return null;
	}
	
	public function getVisibleByAlias($alias) {
	    $page = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `pages` WHERE `alias`=:alias AND `hidden`=0 LIMIT 0,1", array('alias' => $alias)));
	    if ($page != null && is_array($page)) {
	        return $page;
	    }
	    return null;
	}
	
}