<?php
namespace Modules\Main\Models;
use	\System\Basemodel;

if (!defined('SYSTEM')) exit('No direct script access allowed');

/**
 * Users model
 * 
 * @package     Kamele CMS
 * @subpackage  Main
 * @author      Rick Lubbers <me@ricklubbers.nl>
 * @since       0.1
 */
class Users extends Basemodel {
    
    /**
     * Get by ID
     * 
     * @param   int     $id     User ID
     * @return  Array | null
     */
    public function getById($id) {
        $user = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `%susers` WHERE `id`=:id LIMIT 0,1", array('id'=>$id)));
        if ($user != false && $user != null) {
            return $user;
        }
        return null;
    }
    
    /**
     * Get by email address
     * 
     * @param   string  $email  User e-mail address
     * @return  Array | null
     */
    public function getByEmail($email) {
        $user = $this->db->fetchAssoc($this->db->safeQuery("SELECT * FROM `%susers` WHERE `id`=:id LIMIT 0,1", array('id'=>$id)));
        if ($user != false && $user != null) {
            return $user;
        }
        return null;
    }
    
}