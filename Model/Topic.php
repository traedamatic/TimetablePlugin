<?php
/**
 * TopicModel
 *
 *  
 * @author Nicolas Traeder <traeder@codebiltiy.com>
 * @package Timetable
 * @license MIT
 * @version 0.1
 */
App::import('TimetableAppModel','Model');
class Topic extends TimetableAppModel {
	/**
	 * @var string the name of the model
	 */
	public $name = "Topic";
	
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
										  'message' => 'Sie müssen einen Themaname angeben'
										  )
							)
						);
}