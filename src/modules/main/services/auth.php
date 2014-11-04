<?php
namespace Modules\Main\Services;
use	\System\Baseservice;

if (!defined('SYSTEM')) exit('No direct script access allowed');

/**
 * Authentication service
 * 
 * Depends on Crypto library, located in \System\Lib\Kamele
 * 
 * @package     Kamele CMS
 * @subpackage  Main
 * @author      Rick Lubbers <me@ricklubbers.nl>
 * @since       0.1
 */
class Auth extends Baseservice {
    
    /**
     * Whether the user is logged in or not
     * @var     boolean
     */
    private $login = false;
    
    /**
     * User array
     * @var     Array
     */
    private $userdata;
    
    /**
     * Constructor
     * Loads authentication data from session
     */
    public function __construct() {
        if (isset($_SESSION[DB_PREFIX.'login']) && $_SESSION[DB_PREFIX.'login'] == true) {
            $this->userdata = $_SESSION[DB_PREFIX.'user'];
            $this->login = true;
        }
    }
    
    /**
     * Login
     * 
     * @param   string      $email          e-mail address
     * @param   string      $password       password (plaintext)
     * @return  boolean
     */
    public function login($email, $password) {
        $user = $this->loader['\Modules\Main\Models\Users']->getUserByEmail($email);
        if ($this->hashPassword($password, $user['salt']) == $user['password']) {
            $this->login = true;
            $this->userdata = $user;
            return true;
        }
        else {
            $this->login = false;
            $this->userdata = null;
            return false;
        }
    }
    
    /**
     * Logout
     * Destroys session information
     * 
     * @param   boolean     $force          Force session information to be deleted
     * @return  void
     */
    public function logout($force) {
        $this->login = false;
        $this->userdata = null;
        if ($force == true) {
            $_SESSION[DB_PREFIX.'login'] = false;
            $_SESSION[DB_PREFIX.'user'] = null;
        }
    }
    
    /**
     * Password hashing
     * 
     * @param   string      $password       The plaintext password
     * @param   string      $salt           The salt to use
     * @return  string      Encrypted version of the password
     */
    private function hashPassword($password, $salt) {
        return $this->loader['\System\Lib\Kamele\Crypto']->hash_pbkdf2_safe($password, $salt);
    }
    
    /**
     * Destructor fuction
     * Writes changes back to session
     */
    public function __destruct() {
        $_SESSION[DB_PREFIX.'login'] = $this->login;
        $_SESSION[DB_PREFIX.'user'] = $this->userdata;
    }
    
}