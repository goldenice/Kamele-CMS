<?php
namespace Modules\Main\Services;

if (!defined('SYSTEM')) exit('No direct script access allowed');

/**
 * Templating service
 * Handles anything that has to do with templating
 * 
 * @package     Kamele CMS
 * @subpackage  Main
 * @author      Rick Lubbers <me@ricklubbers.nl>
 * @since       0.1
 */
class Templating extends \System\Baseservice {
    
    private $template_base_dir = 'modules/templates/';
    private $template;
    
    public function __construct() {
        parent::__construct();
        
        $template = $this->loader['\Modules\Main\Models\Settings']->getSetting('template');
        if ($template == null or $this->templateExists($template) == false) {
            if ($this->templateExists('default')) {
                $this->template = 'default';
            }
            else {
                throw new \Exception('Cannot find template');
            }
        }
        else {
            $this->template = $template;
        }
    }
    
    public function getTemplateDirectory() {
        return $this->template;
    }
    
    private function templateExists($dir) {
        if (file_exists($this->template_base_dir.$dir) and is_dir($this->template_base_dir.$dir)) {
            return true;
        }
        return false;
    }
    
}