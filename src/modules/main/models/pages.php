<?php
namespace Modules\Main\Models;
use	\System\Basemodel;

if (!defined('SYSTEM')) exit('No direct script access allowed');

/**
 * Pages model
 * 
 * @package		Kamele CMS
 * @subpackage	Main
 * @author		Rick Lubbers <me@ricklubbers.nl>
 * @since		0.1
 */
class Pages extends Basemodel {
	
	/**
     * Gets by ID
     * 
     * @param   int     $id     The ID of the item to fetch
     * @return  Array | null
     */
	public function getById($id) {
	    $page = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `%spages` WHERE `id`=:id LIMIT 0,1", array('id'=>$id)));
	    if ($page != null && is_array($page)) {
	        return $page;
	    }
	    return null;
	}
	
	/**
     * Gets only visible items by ID
     * 
     * @param   int     $id     The ID of the item to fetch
     * @return  Array | null
     */
	public function getVisibleById($id) {
	    $page = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `%spages` WHERE `id`=:id AND `hidden`=0 LIMIT 0,1", array('id' => $id)));
        if ($page != null && is_array($page)) {
            return $page;
        }
        return null;
	}
	
	/**
     * Gets by alias
     * 
     * @param   string  $id     The ID of the item to fetch
     * @return  Array | null
     */
	public function getByAlias($alias) {
	    $page = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `%spages` WHERE `alias`=:alias LIMIT 0,1", array('alias'=>$alias)));
	    if ($page != null && is_array($page)) {
	        return $page;
	    }
	    return null;
	}
	
	/**
     * Gets only visible items by alias
     * 
     * @param   string  $id     The ID of the item to fetch
     * @return  Array | null
     */
	public function getVisibleByAlias($alias) {
	    $page = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `%spages` WHERE `alias`=:alias AND `hidden`=0 LIMIT 0,1", array('alias' => $alias)));
	    if ($page != null && is_array($page)) {
	        return $page;
	    }
	    return null;
	}
	
	/**
	 * Update an article
	 * 
	 * @param   int     $id         The ID of the article to update
	 * @parem   string  $title      New title of the article
	 * @param   string  $body       The body HTML
	 */
	public function updateById($id, $title, $body) {
	    $result = $this->db->safeQuery("UPDATE `pages` SET `title`=:title, `body`=:body, `last_edit`=:time WHERE `id`=:id",
	        array('id'=>$id, 'title'=>$title, 'body'=>$body, 'time'=>time()));
	    if ($result !== false and $result !== null) {
	        return true;
	    }
	    return false;
	}
	
	/**
	 * Insert new article
	 * 
	 * @param   string  $title      The title of the article
	 * @param   string  $body       Body HTML
	 */
	public function insert($title, $body) {
        $result = $this->db->safeQuery("INSERT INTO `pages` (title, body, hidden, last_edit, added) VALUES (:title, :body, 0, :time, :time)",
                array('title'=>$title, 'body'=>$body, 'time'=>time()));
        if ($result !== false and $result !== null) {
            return true;
        }
        return false;
	}
}