<?php
/**
 * Timetable App Controller
 *
 * plugin wide action are definied here
 *  
 * @author Nicolas Traeder <traeder@codebiltiy.com>
 * @package Timetable
 * @license MIT
 * @version 0.1
 */
App::uses('AppController','Controller');
class TimetableAppController extends AppController {
	
	/**
	 * @var string controller name
	 *
	 */
	public $name = "TimetableApp";
	
   /**
	 *	this plugin needs following components
	 *
	 * Session
	 * Auth
	 * RequestHandler
	 *	
	 * @var array plugin wide components
	 */	
   public $components = array('Auth','Session','RequestHandler');
		
	/**
	 *	this plugin needs following helpers
	 *
	 * Time
	 * Form
	 * Js
	 * Html
	 *	
	 * @var array plugin wide helpers
	 */	
   public $helpers = array('Time','Text','Form','Js' => array('Jquery'),'Csscrush.Csscrush');
   
	/**
	 * plugin wide beforeFitler
	 * should call the parent beforeFlter
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		Configure::load('Timetable.timetable');		
		
		//load Settings
		$Setting = ClassRegistry::init('Setting');
		Configure::write('Timetable.Settings',$Setting->find('first'));
		ClassRegistry::removeObject('Setting');
		
		$this->Auth->deny();		
		$this->Auth->allow(array('index','view'));				
	}
	
	/**
	 * plugin wide beforeRender
	 *
	 */
	public function beforeRender() {
		parent::beforeRender();
		
		//set default theme
		$this->theme = 'Default';
		
		$theme = Configure::read('Timetable.Settings.Setting.theme');		
		if($theme != 'default' && !empty($theme) ) $this->theme = Configure::read('Timetable.Settings.Setting.theme');
		
		if(isset($this->request->params['manager']) && !$this->request->is('ajax'))
			$this->layout = 'manager';
	}
}

