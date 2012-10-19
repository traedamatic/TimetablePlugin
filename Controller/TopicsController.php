<?php
/**
 * TopicsController
 *
 *  
 * @author Nicolas Traeder <traeder@codebiltiy.com>
 * @package Timetable
 * @license MIT
 * @version 0.1
 */
class TopicsController extends TimetableAppController {
	
	/**
	 * @var string controller name
	 *
	 */
	public $name = "Topics";
			
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
		$this->set('topics',$this->Topic->find('all'));
	}
	
	/**
	 * function view a single event
	 */
	public function view($topicId = null) {
		if(is_null($topicId)) throw new BadRequestException('topic Id is missing');
		
		$this->Topic->id = $topicId;
		$topic = $this->Topic->read();
		
		if(empty($topic)) {
			throw new NotFoundException('topic could not be found');
		}
		
		if (!empty($this->request->params['requested'])) {			
			return $topic;
		}
		
		$this->set(compact('topic'));			
	}
	
	/**
	 *
	 * manager index function overview over all topics
	 */
	public function manager_index() {
		$topics = $this->Topic->find('all');
		$this->set(compact('topics'));
	}
	
	/**
	 *
	 * manager add
	 *
	 * add a new topic
	 */
	public function manager_add() {
		if($this->request->is('post')) {
			$this->Topic->set($this->data);			
			
			if($this->Topic->save($this->data)) {
				$this->Session->setFlash(__("Thema angelegt!"),'/flash/success');
				$this->redirect(array('action' => 'index'));
			} 		
		} 
	}
	
	/**
	 *
	 * manager edit
	 *
	 * add a new topic
	 */
	public function manager_edit($topicId = null) {
		if(is_null($topicId)) $this->redirect(array('action' => 'index'));			
		
		$this->Topic->id = $topicId;
		$topic = $this->Topic->read();
		
		if(empty($topic)) {
			$this->Session->setFlash(__("Thema wurde nicht gefunden!"),'/flash/error');
			$this->redirect(array('action' => 'index'));			
		}	
		
		if($this->request->is('post')) {
			$this->Topic->set($this->data);
			if($this->Topic->save($this->data)) {
					$this->Session->setFlash(__("Thema angelegt!"),'/flash/success');
					$this->redirect(array('action' => 'index'));
			} 			
		} else {				
			$this->request->data = $topic;
		}
	}
	
	/**
	 *
	 * manager delete 
	 */
	public function manager_delete($topicId = null) {
		if(is_null($topicId)) $this->redirect(array('action' => 'index'));
		
		if($this->Topic->delete($topicId)) {
			$this->Session->setFlash(__("Thema gelöscht!"),'/flash/success');			
		} else {
			$this->Session->setFlash(__("Thema konnte nicht gelöscht werden!"),'/flash/success');
		}
		
		$this->redirect(array('action' => 'index'));
	}
	
	/**
	 *
	 * manager view 
	 */
	public function manager_view($topicId = null) {
		if(is_null($topicId)) $this->redirect(array('action' => 'index'));
		
		$this->Topic->id = $topicId;
		
		$topic = $this->Topic->read();
		
		if(empty($topic)) {
			$this->Session->setFlash(__("Thema konnte nicht gefunden werden!"),'/flash/success');
			$this->redirect(array('action' => 'index'));
		}
		
		$this->set(compact('topic'));
	}
	
}
	