<?php
namespace Modules\Main\Models;
use \System\Basemodel;

if (!defined('SYSTEM')) exit('No direct script access allowed');

/**
 * Settings model
 * Gets and puts settings into the database
 * 
 * @package 	Kamele CMS
 * @subpackage	Main
 * @author		Rick Lubbers <me@ricklubbers.nl>
 * @since		0.1
 */
class Settings extends Basemodel {
    
    public function getKey($key) {
        $result = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `%ssettings` WHERE `key`=:key LIMIT 0,1", array('key'=>$key)));
        if ($result === null) {
            return null;
        }
        else {
            return $result['value'];
        }
    }
    
    public function updateKey($key, $value) {
    	$result = $this->db->safeQuery("INSERT INTO `%ssettings` (key, value) VALUES (:key, :value) ON DUPLICATE KEY UPDATE `value`=:value");
    	if ($result == false || $result == null) {
    		return false;
    	}
    	else {
    		return true;
    	}
    }
    
}