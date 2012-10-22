<?php
/**
 * WorkshopsController
 *
 *  
 * @author Nicolas Traeder <traeder@codebiltiy.com>
 * @package Timetable
 * @license MIT
 * @version 0.1
 */

class WorkshopsController extends TimetableAppController {
	
	/**
	 * @var string controller name
	 *
	 */
	public $name = "Workshops";
	
	/**
	 *  beforeFitler
	 * 
	 */
	public function beforeFilter() {
		parent::beforeFilter();			
	}
	
	/**
	 *
	 * standard index function
	 * only ajax right now.
	 */	
	public function index() {
		//
		//$this->set('workshops',$this->Workshop->find('all'));
		$this->set('workshops',$this->Workshop->find('all',array('conditions' => array('Workshop.active' => '1'))));
	}
	
	/**
	 * function view a single event
	 */
	public function view($workshopId = null) {
		if(is_null($workshopId)) throw new BadRequestException('workshop Id is missing');
		
		$this->Workshop->id = $workshopId;
		$workshop = $this->Workshop->read();
		
		if(empty($workshop)) {
			throw new NotFoundException('workshop could not be found');
		}
	
		$this->set(compact('workshop'));			
	}
	
	
	/**
	 *
	 * manager index function overview over all events
	 */
	public function manager_index() {
		$workshops = $this->Workshop->find('all');
		$this->set(compact('workshops'));
		
		$this->set('countActiveWorkshops',$this->Workshop->find('count',array('conditions' => array('Workshop.active' => '1'))));
	}
	
	
	/**
	 *
	 * manager add
	 *
	 * add a new event
	 */
	public function manager_add() {
		
		//this->set('topics',$this->_formatTopics());
		
		if($this->request->is('post')) {			
			if($this->Workshop->save($this->data)) {
					$this->Session->setFlash(__("Workshop angelegt!"),'/flash/success');
					$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__("Workshop konnte nicht angelegt werden!"),'/flash/success');
				$this->set('onErrors',true);
				$this->_setEventsAndSpeakers();
			}			
		} else {
			
			$this->_setEventsAndSpeakers();
			
		}
	}
	
	/**
	 *
	 * return the topics in the right format
	 */
	private function _formatTopics() {		
		$topics = array();		
		foreach(Configure::read('Timetable.Settings.Setting.topic') as $topic) {
			$topics[$topic['name']] = $topic['name'];
		}
		
		//read default Topics
		if(empty($topics)) {
			foreach(Configure::read('Workshops.Topics') as $topic) {
			$topics[$topic['name']] = $topic['name'];
		}
		}
		
		return  $topics;
	}
	
	/**
	 *
	 * manager edit
	 *
	 * edit a workshop
	 */
	public function manager_edit($workshopId = null) {
		if(is_null($workshopId)) $this->redirect(array('action' => 'index'));			
		
		$this->Workshop->id = $workshopId;
		$workshop = $this->Workshop->read();
		
		if(empty($workshop)) {
			$this->Session->setFlash(__("Workshop wurde nicht gefunden!"),'/flash/error');
			$this->redirect(array('action' => 'index'));			
		}
				
		$workshop['Workshop']['speakers'] = array_combine($workshop['Workshop']['speakers'],array_fill(0,count($workshop['Workshop']['speakers']),'1'));				
		
		if($this->request->is('post')) {
			$this->Workshop->set($this->data);
			if($this->Workshop->save($this->data)) {
					$this->Session->setFlash(__("Workshop angelegt!"),'/flash/success');
					$this->redirect(array('action' => 'index'));									
			} else {
				$this->Session->setFlash(__("Workshop konnte nicht angelegt werden!"),'/flash/error');
				
				$this->set('topics',$this->_formatTopics());
			
				$this->_setEventsAndSpeakers();
			}			
		} else {		
			
			//$this->set('topics',$this->_formatTopics());
			
			$this->_setEventsAndSpeakers();
			
			$this->request->data = $workshop;
		}
	}
	
	/***
	 *
	 * gets events and speakers from the db and sets the view vars;
	 */
	private function _setEventsAndSpeakers() {
		//workaround for mongodb datasource bug. internal error it the collection is empty and you call ->find('list');
		$this->loadModel('Speaker');
		
		$speakers = $this->Speaker->find('count');			
		
		if($speakers > 0) $speakers = $this->Speaker->find('list',array('order' => array('Speaker.created' => -1)));
		if($speakers == 0) $speakers = array();
		
		$this->loadModel('Event');
		
		$events = $this->Event->find('count');			
		
		if($events > 0) $events = $this->Event->find('list');
		if($events == 0) $events = array();
		
		$this->loadModel('Topic');
		$topics = $this->Topic->find('count');		
		
		if($topics > 0) $topics = array_merge(array('-1' => 'Kein Thema'),$this->Topic->find('list'));
		if($topics == 0) $topics = array('-1' => 'Kein Thema');
		
		
		$this->set(compact('speakers','events','topics'));
	}
	
	/**
	 *
	 * manager delete 
	 */
	public function manager_delete($workshopId = null) {
		if(is_null($workshopId)) $this->redirect(array('action' => 'index'));
		
		if($this->Workshop->delete($workshopId)) {
			$this->Session->setFlash(__("Workshop gelöscht!"),'/flash/success');			
		} else {
			$this->Session->setFlash(__("Workshop konnte nicht gelöscht werden!"),'/flash/success');
		}
		
		$this->redirect(array('action' => 'index'));
	}
	
}