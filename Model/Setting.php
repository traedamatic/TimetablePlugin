<?php
/**
 * EventModel
 *
 *  
 * @author Nicolas Traeder <traeder@codebiltiy.com>
 * @package Timetable
 * @license MIT
 * @version 0.1
 */
App::import('TimetableAppModel','Model');
class Setting extends TimetableAppModel {
	/**
	 * @var string the name of the model
	 */
	public $name = "Setting";
	
	/**
	 * @var array the database schema for this model
	 */
	public $_schema = array(
								'theme' => array('type' => 'string', 'length' => 30)
							);
	
	/**
	 *
	 * default settings for the timetable plugin
	 */
	public $defaultSettings = array('Setting' => array(
					'theme' => "default"
					)
				);
	
	/**
	 *
	 * @var array the validation rule
	 * validation rule
	 * 
	 */
	public $validate = array();
	
	/**
	 *
	 * custom beforeSave
	 */
	public function beforeSave() {
		foreach($this->data['Setting']['topic'] as $index => $topic) {
				if(empty($topic['name']) || empty($topic['color'])) unset($this->data['Setting']['topic'][$index]);
			}
		return true;
	}
	
	
	/**
	 *
	 * get themes from disk 
	 */
	public function getThemes() {
		$themePath = APP.DS.'View'.DS.'Themed';
		
		if(is_dir($themePath)) {
			$themes = array();
			foreach(glob($themePath.DS.'*') as $theme){				
				$themes[basename($theme)] = basename($theme);
			}			
			return $themes;
		}
	}
}
		