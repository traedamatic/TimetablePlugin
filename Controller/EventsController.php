<?php
/**
 * EventsController
 *
 *  
 * @author Nicolas Traeder <traeder@codebiltiy.com>
 * @package Timetable
 * @license MIT
 * @version 0.1
 */

class EventsController extends TimetableAppController {
	
	/**
	 * @var string controller name
	 *
	 */
	public $name = "Events";
	
	
	/**
	 *
	 * index function
	 */
	public function index() {			
		$events = $this->Event->find('all');		
		
		$this->loadModel('Workshop');		
		
		foreach($events as $index => $event){
			$events[$index]['Event']['workshops'] = array();
			$events[$index]['Event']['workshops'] = array_keys($this->Workshop->find('list',array('conditions' => array('Workshop.event_id' => $event['Event']['_id']))));
		}
		
		$this->set('events',$events);	
	}
	
	/**
	 * function view a single event
	 */
	public function view($eventId = null) {
		if(is_null($eventId)) throw new BadRequestException('Event Id is missing');
		
		$this->Event->id = $eventId;
		$event = $this->Event->read();
		
		if(empty($event)) {
			throw new NotFoundException('Event could not be found');
		}
		
		$this->loadModel('Workshop');		
		$event['Event']['workshops'] = array_keys($this->Workshop->find('list',array('conditions' => array('Workshop.event_id' => $event['Event']['_id']))));
				
		$this->set(compact('event'));		
	}
	
	/**
	 *
	 * manager index function overview over all events
	 */
	public function manager_index() {
		$events = $this->Event->find('all');		
		$this->set(compact('events'));
	}
	
	/**
	 *
	 * manager add
	 *
	 * add a new event
	 */
	public function manager_add() {
		if($this->request->is('post')) {		
			if($this->Event->save($this->data)) {
					$this->Session->setFlash(__("Veranstaltung angelegt!"),'/flash/success');
					$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__("Veranstaltung konnte nicht angelegt werden!"),'/flash/success');
			}			
		}		
	}
	
	/**
	 *
	 * return events days by id
	 */
	public function manager_eventdays($eventId = null) {
		if(is_null($eventId)) throw new BadRequestException('Event Id is missing');
		
		$this->layout = 'ajax';
		
		$this->Event->id = $eventId;
		$event = $this->Event->read();
		
		$options = array();
	
		$beginDate = new DateTime(implode('-',$event['Event']['begin']));
		$endDate = new DateTime(implode('-',$event['Event']['end']));
		$days = $beginDate->diff($endDate)->days;
		
		
		$options[$beginDate->format('d-m-Y')] = 'Tag 1: '.$beginDate->format('d-m-Y');
		for($i=0;$i< $days;$i++) {
			$modifiedDate = $beginDate->modify("+1 days")->format('d-m-Y');
			$options[$modifiedDate] = 'Tag '.($i+2).': '.$modifiedDate;
		}
		
		if (!empty($this->request->params['requested'])) {			
			return $options;
		}
		
		$this->set(compact('options'));		
	}
	/**
	 *
	 * manager edit
	 *
	 * add a new event
	 */
	public function manager_edit($eventId = null) {
		if(is_null($eventId)) $this->redirect(array('action' => 'index'));			
		
		$this->Event->id = $eventId;
		$event = $this->Event->read();
		
		if(empty($event)) {
			$this->Session->setFlash(__("Veranstaltung wurde nicht gefunden!"),'/flash/error');
			$this->redirect(array('action' => 'index'));			
		}
		
		if($this->request->is('post')) {
			$this->Event->set($this->data);
			if($this->Event->save($this->data)) {
					$this->Session->setFlash(__("Veranstaltung angelegt!"),'/flash/success');
					$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__("Veranstaltung konnte nicht angelegt werden!"),'/flash/error');
			}			
		} else {		
		
			$this->request->data = $event;
		}
	}
	
	/**
	 *
	 * manager delete 
	 */
	public function manager_delete($eventId = null) {
		if(is_null($eventId)) $this->redirect(array('action' => 'index'));
		
		if($this->Event->delete($eventId)) {
			$this->Session->setFlash(__("Veranstaltung gelöscht!"),'/flash/success');			
		} else {
			$this->Session->setFlash(__("Veranstaltung konnte nicht gelöscht werden!"),'/flash/success');
		}
		
		$this->redirect(array('action' => 'index'));
	}
	
}
	