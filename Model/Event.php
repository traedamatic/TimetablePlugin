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
class Event extends TimetableAppModel {
	/**
	 * @var string the name of the model
	 */
	public $name = "Event";
	
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
															'message' => 'Sie müssen einen Veranstaltungsname angeben'
															)
											 )
						);
	
	/**
	 * before save
	 *
	 * manipulate cakephp date to 
	 * 
	 */
}

