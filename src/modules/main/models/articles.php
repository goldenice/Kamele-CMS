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
    
    /**
     * Gets by ID
     * 
     * @param   int     $id     The ID of the item to fetch
     * @return  Array | null
     */
    public function getById($id) {
	    $article = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `%sarticles` WHERE `id`=:id LIMIT 0,1", array('id'=>$id)));
	    if ($article != null && is_array($article)) {
	        return $article;
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
	    $cur_time = time();
	    $article = $this->db->fetchAssoc($this->db->safeQuery(
	        "SELECT * FROM `%sarticles` WHERE `id`=:id AND `publish_from`<=:time AND (`publish_to`>=:time OR `publish_to`=0) AND `hidden`=0 LIMIT 0,1"
	        ,
	        array(
	            'id'    => $id,
	            'time'  => $cur_time   
	            )));
        if ($article != null && is_array($article)) {
            return $article;
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
	    $article = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `%sarticles` WHERE `alias`=:alias LIMIT 0,1", array('alias'=>$alias)));
	    if ($page != null && is_array($article)) {
	        return $article;
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
	    $cur_time = time();
	    $article = $this->db->fetchAssoc($this->db->safeQuery(
	        "SELECT * FROM `%sarticles` WHERE `alias`=:alias AND `publish_from`<=:time AND (`publish_to`>=:time OR `publish_to`=0) AND `hidden`=0 LIMIT 0,1"
	        , array(
	            'alias' => $alias,
	            'time' => $cur_time
	            )));
	    if ($article != null && is_array($article)) {
	        return $article;
	    }
	    return null;
	}
	
	/**
	 * Gets a number of visible articles
	 * 
	 * @param   int     $start      The number of items to start with
	 * @param   int     $number     The number of articles to show
	 * @return  Array
	 */
	public function getVisibleList($start, $amount) {
		$start = (int) $start;			// This is terrible SQL-escaping. But it works okay enough for now. PDO is a bitch.
		$amount = (int) $amount;		// TODO: fix this terrible escaping.
	    $cur_time = time();
	    $articles = $this->db->safeQuery("   SELECT * 
	                                                            FROM `%sarticles` 
	                                                            WHERE `publish_from`<=:time 
	                                                                AND (`publish_to`>=:time OR `publish_to`=0) 
	                                                                AND `hidden`=0 
	                                                            ORDER BY `publish_from` DESC 
	                                                            LIMIT $start,$amount",
	                                        array('time'=>$cur_time));
	    $articles = $this->db->toArray($articles);
	    if ($articles != null && is_array($articles)) {
	        return $articles;
	    }
	    return array();
	}
	
	/**
	 * Update an article
	 * 
	 * @param   int     $id         The ID of the article to update
	 * @parem   string  $title      New title of the article
	 * @param   string  $body       The body HTML
	 */
	public function updateById($id, $title, $body) {
	    $result = $this->db->safeQuery("UPDATE `articles` SET `title`=:title, `body`=:body, `last_edit`=:time WHERE `id`=:id",
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
        $result = $this->db->safeQuery("INSERT INTO `articles` (title, body, publish_from, publish_to, hidden, last_edit, added) VALUES (:title, :body, :time, 0, 0, :time, :time)",
                array('title'=>$title, 'body'=>$body, 'time'=>time()));
        if ($result !== false and $result !== null) {
            return true;
        }
        return false;
	}
}