<?php
namespace Modules\Main\Services;
use \System\Baseservice;

if (!defined('SYSTEM')) exit('No direct script access allowed');

/**
 * Article service
 * Generates articles in the correct format
 * 
 * @package     Kamele CMS
 * @subpackage  Main
 * @author      Rick Lubbers <me@ricklubbers.nl>
 * @since       0.1
 */
class Articles extends Baseservice {
    
    private $date_formatting;
    private $date_formatting_html = 'Y-m-d\TH:i:s\Z';
    private $intro_length;
    
    public function __construct() {
        $this->date_formatting = $this->loader['\Modules\Main\Models\Settings']->getKey('date_format');
    }
    
    public function getLatest($page) {
        $itemsperpage = $this->loader['\Modules\Main\Models\Settings']->getKey('articles_per_page');
        if ($itemsperpage === false)
            $itemsperpage = $this->default_items_per_page;
        
        $page--;
        
        $articles = $this->loader['\Modules\Main\Models\Articles']->getVisibleList($page*$itemsperpage, (($page+1)*$itemsperpage)-1);
        foreach ($articles as $key=>$article) {
            $this->normalize($article);
        }
    }
    
    public function normalize(&$article) {
        $article['human_publish_from']  = date($this->date_formatting, $article['publish_from']);
        $article['human_publish_to']    = date($this->date_formatting, $article['publish_']);
        $article['human_last_edit']     = date($this->date_formatting, $article['last_edit']);
        $article['human_added']         = date($this->date_formatting, $article['added']);
        $article['internat_publish_from']  = date($this->date_formatting_html, $article['publish_from']);
        $article['internat_publish_to']    = date($this->date_formatting_html, $article['publish_']);
        $article['internat_last_edit']     = date($this->date_formatting_html, $article['last_edit']);
        $article['internat_added']         = date($this->date_formatting_html, $article['added']);
    }
    
}