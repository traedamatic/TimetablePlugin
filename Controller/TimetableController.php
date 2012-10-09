<?php
/**
 * Timetable Controller
 *
 *  
 * @author Nicolas Traeder <traeder@codebiltiy.com>
 * @package Timetable
 * @license MIT
 * @version 0.1
 */

class TimetableController extends TimetableAppController {
	
	/**
	 * @var string controller name
	 *
	 */
	public $name = "Timetable";
	
	/**
	 * @var array what model does this controller use?
	 *
	 */
	public $uses = array();
	
	/**
	 *
	 * timetable dashboard
	 */
	public function manager_dashboard() {
		$this->loadModel('Event');		
		$countEvents = $this->Event->find('count');
		
		$this->loadModel('Workshop');
		$countWorkshops = $this->Workshop->find('count');
		
		$this->loadModel('Speaker');
		$countSpeakers = $this->Speaker->find('count');
		
		$this->set(compact(array('countSpeakers','countWorkshops', 'countEvents')));
	}
	
	/**
	 * main index function of the timetable app
	 *
	 */
	public function index() {
			
		
		$this->loadModel('Setting');
		$setting = $this->Setting->find('first');		
		$this->set(compact('setting'));
		
		$this->layout = "default";
		
		if($setting['Setting']['theme'] != 'default') $this->theme = $setting['Setting']['theme'];
					
	}


}
	