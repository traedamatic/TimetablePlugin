<?php
/**
 * Speaker Model
 *
 *  
 * @author Nicolas Traeder <traeder@codebiltiy.com>
 * @package Timetable
 * @license MIT
 * @version 0.1
 */
App::import('TimetableAppModel','Model');
class Speaker extends TimetableAppModel {
	/**
	 * @var string the name of the model
	 */
	public $name = "Speaker";
	
	/**
	 * @var array the database schema for this model
	 */
	public $_schema = array();
	
	/**
	 * @var array the validation rules for this model
	 */
	public $validate = array(
						'name' => array(
											 'notEmpty' => array(
															'rule' => "notEmpty",
															'message' => 'Jeder Referent hat einen Namen! Ja, ganz sicher!'
															)
											 )
						);
	
	public function beforeSave($options = array()) {
		//cast the position to int
		$this->data['Speaker']['position'] = (int)($this->data['Speaker']['position']);
	}
}