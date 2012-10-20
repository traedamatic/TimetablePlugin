<?php
/**
 * Workshop Model
 *
 *  
 * @author Nicolas Traeder <traeder@codebiltiy.com>
 * @package Timetable
 * @license MIT
 * @version 0.1
 */
App::import('TimetableAppModel','Model');
class Workshop extends TimetableAppModel {
	/**
	 * @var string the name of the model
	 */
	public $name = "Workshop";
	
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
															'message' => 'Sie müssen einen Workshopnamen angeben'
															)
											 ),
						'day' => array(
											 'notEmpty' => array(
															'rule' => "notEmpty",
															'message' => 'Bitte geben Sie einen Tag an'
															)
											 ),
						'location' => array(
											 'notEmpty' => array(
															'rule' => "notEmpty",
															'message' => 'Bitte geben Sie einen Tag an'
															)
											 ),
						'referent_id' => array(
											 'notEmpty' => array(
															'rule' => "notEmpty",
															'message' => 'Bitte geben Sie einen Tag an'
															)
											 )
						);
	
	/**
	 *
	 * before save
	 */
	public function beforeSave() {		
		//$topicName = $this->data['Workshop']['topic'];
		//$currentTopic = current(array_filter(Configure::read('Timetable.Settings.Setting.topic'),function($topic) use ($topicName) {
		//	return $topic['name'] === $topicName;
		//}));
		//
		//$this->data['Workshop']['color'] =  $currentTopic['color'];
		
		$this->data['Workshop']['speakers'] = array_keys(array_filter($this->data['Workshop']['speakers'],function($speakerId){
																return $speakerId != '0';
															}));
		
		$this->schema(true);		
		return true;
	}	
}