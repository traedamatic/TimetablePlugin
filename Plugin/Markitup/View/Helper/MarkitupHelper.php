<?php
//App::import('Vendor', 'Markitup.Stubparser/Stubparser');
/** 
 * markItUp! Helpers 
 * @author Jay Salvat 
 * @version 1.0 
 * 
 * Download markItUp! at: 
 * http://markitup.jaysalvat.com 
 * Download jQuery at: 
 * http://jquery.com
 *
 * imgrate to Cake 2.0 beta 28.08.11
 */
//App::import('Core', 'Debugger');
//App::uses('Debugger', 'Core');
//App::uses('String','Utility');
App::uses('AppHelper','View/Helper');

class MarkitupHelper extends AppHelper {
	
	public $name = "Markitup";
	
    public $helpers = array('Html', 'Form', 'Js' => array('Jquery')); 
     
    /** 
     * Generates a form textarea element complete with label and wrapper div with markItUp! applied. 
     * @param  string $fieldName This should be "Modelname.fieldname" 
     * @param  array $settings 
     * @return string  An <textarea /> element. 
     */ 
    public function editor($name, $settings = array()) { 
        $config = $this->_build($settings); 
        $settings = $config['settings']; 
        $default = $config['default']; 
        $textarea = array_diff_key($settings, $default); 
        $textarea = am($textarea, array('type' => 'textarea')); 
        $editor = $this->Form->input($name, $textarea); 
        $id = '#'.parent::domId($name);		
		//changed the Javascript to JsEngine
        $editor.= $this->Js->buffer('$(function() { jQuery("'.$id.'").markItUp('.$settings['settings'].', { previewParserPath:"'.$settings['parser'].'" } ); });');
		
        return $this->output($editor); 
    } 

    /** 
     * Link to build markItUp! on a existing textfield 
     * @param  string $title The content to be wrapped by <a> tags. 
     * @param  string $fieldName This should be "Modelname.fieldname" or specific domId as #id. 
     * @param  array  $settings 
     * @param  array  $htmlAttributes Array of HTML attributes. 
     * @param  string $confirmMessage JavaScript confirmation message. 
     * @return string An <a /> element.     
     */ 
    public function create($title, $fieldName = "", $settings = array(), $htmlAttributes = array(), $confirmMessage = false) { 
        $id = ($fieldName{0} === '#') ? $fieldName : '#'.parent::domId($fieldName); 
         
        $config = $this->_build($settings); 
        $settings = $config['settings']; 
        $htmlAttributes = am($htmlAttributes, array('onclick' => '$("'.$id.'").markItUpRemove(); $("'.$id.'").markItUp('.$settings['settings'].', { previewParserPath:"'.$settings['parser'].'" }); return false;'));
        return $this->Html->link($title, "#", $htmlAttributes, $confirmMessage, false); 
    }     

    /** 
     * Link to destroy a markItUp! editor from a textfield 
     * @param string  $title The content to be wrapped by <a> tags. 
     * @param string  $fieldName This should be "Modelname.fieldname" or specific domId as #id. 
     * @param array   $htmlAttributes Array of HTML attributes. 
     * @param string  $confirmMessage JavaScript confirmation message. 
     * @return string An <a /> element.     
     */ 
    public function destroy($title, $fieldName = "", $htmlAttributes = array(), $confirmMessage = false) { 
        $id = ($fieldName{0} === '#') ? $fieldName : '#'.parent::domId($fieldName); 
        $htmlAttributes = am($htmlAttributes, array('onclick' => '$("'.$id.'").markItUpRemove(); return false;')); 
        return $this->Html->link($title, "#", $htmlAttributes, $confirmMessage, false); 
    } 

    /** 
     * Link to add content to the focused textarea 
     * @param string  $title The content to be wrapped by <a> tags. 
     * @param string  $fieldName This should be "Modelname.fieldname" or specific domId as #id. 
     * @param mixed   $content String or array of markItUp! options (openWith, closeWith, replaceWith, placeHolder and more. See markItUp! documentation for more details : http://markitup.jaysalvat.com/documentation
     * @param array   $htmlAttributes Array of HTML attributes. 
     * @param string  $confirmMessage JavaScript confirmation message. 
     * @return string An <a /> element.     
     */ 
    public function insert($title, $fieldName = null, $content = array(), $htmlAttributes = array(), $confirmMessage = false) {
        if (isset($fieldName)) { 
            $content['target'] = ($fieldName{0} === '#') ? $fieldName : '#'.parent::domId($fieldName); 
        } 
        if (!is_array($content)) { 
            $content['replaceWith'] = $content; 
        } 
        $properties = ''; 
        foreach($content as $k => $v) { 
            $properties .= $k.':"'.addslashes($v).'",'; 
        } 
        $properties = substr($properties, 0, -1); 
         
        $htmlAttributes = am($htmlAttributes, array('onclick' => '$.markItUp( { '.$properties.' } ); return false;')); 
        return $this->Html->link($title, "#", $htmlAttributes, $confirmMessage, false); 
    } 

    /** 
     * Parser to use in the preview 
     * @param string  $content The content to be parsed. 
     * @return string Parsed content.     
     */ 
    public function parse($content, $parser = '') {		
    // This Helper is designed to be used with several kinds of parser 
    // in a same project. 
        // Drop your favorite parsers in the /vendor/ folder and edit lines below. 
        switch($parser) { 
            case 'bbcode': 
                // App::import('Vendor', 'bbcode', array('file' => 'myFavoriteBbcodeParser')); 
                // $parsed = myFavoriteBbcodeParser($content);         
                break; 
            case 'textile': 
                // App::import('Vendor', 'textile', array('file' => 'myFavoriteTextileParser')); 
                // $parsed = myFavoriteTextileParser($content);         
                break; 
            case 'markdown': 
                App::import('Vendor', 'Markitup.PHPMarkdown/markdown');
                $parsed = Markdown($content);
                break; 
            default: 
                // App::import('Vendor', 'favorite', array('file' => 'myFavoriteFavoriteParser')); 
                // $parsed = myFavoriteFavoriteParser($content); 
        } 
        return $parsed; 
    } 
   

    /** 
     * Private function. 
     * Builds the settings array and add includes. 
     */     
    private function _build($settings) { 
        $default = array(   'set' => 'default',  
                            'skin' => 'markitup',  
                            'settings' => 'mySettings', 
                            'parser' => ''); 
        $settings = am($default, $settings); 
        if ($settings['parser']) { 
            $settings['parser'] = $this->Html->url($settings['parser']); 
        }
		
		//alter syntax for cakephp 2.0
		$this->Html->script('/Markitup/js/markitup//jquery.markitup.js',array('inline' => false)); 
		
        $this->Html->script('/Markitup/js/markitup/sets/'.$settings['set'].'/set.js',array('inline' => false)); 
        $this->Html->css('/Markitup/css/markitup/skins/'.$settings['skin'].'/style.css', null,array('inline' => false)); 
        $this->Html->css('/Markitup/css/markitup/sets/'.$settings['set'].'/style.css',null,array('inline' => false)); 

        return array('settings' => $settings, 'default' => $default); 
    }
}