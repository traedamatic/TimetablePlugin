<?php
/**
 * SpeakersController
 *
 *  
 * @author Nicolas Traeder <traeder@codebiltiy.com>
 * @package Timetable
 * @license MIT
 * @version 0.1
 */
class SpeakersController extends TimetableAppController {
	
	/**
	 * @var string controller name
	 *
	 */
	public $name = "Speakers";
	
	/**
	 * the path files/speakers has to be writeable (chmod 777)
	 * @var array controller components
	 */
	public $components = array('Timetable.Uploadfile' => array(
													'uploadPath' => 'files/speakers'
													));
	
	/**
	 *  beforeFitler
	 * 
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		//$this->Auth->deny();
		//$this->Auth->allow(array('index','view'));
		//		
	}
	
	/**
	 *
	 * standard index function
	 * only ajax right now.
	 */	
	public function index() {				
		$this->set('speakers',$this->Speaker->find('all',array('order' => array('Speaker.position' => 'ASC'))));		
	}
	
	/**
	 * function view a single event
	 */
	public function view($speakerId = null) {
		if(is_null($speakerId)) throw new BadRequestException('speaker Id is missing');
		
		$this->Speaker->id = $speakerId;
		$speaker = $this->Speaker->read();
		
		if(empty($speaker)) {
			throw new NotFoundException('speaker could not be found');
		}
		
		if (!empty($this->request->params['requested'])) {			
			return $speaker;
		}
		
		$this->set(compact('speaker'));			
	}
	
	/**
	 *
	 * manager index function overview over all speakers
	 */
	public function manager_index() {
		$speakers = $this->Speaker->find('all',array('order' => array('Speaker.position' => 'ASC')));
		$this->set(compact('speakers'));
	}
	
	/**
	 *
	 * manager add
	 *
	 * add a new speaker
	 */
	public function manager_add() {
		if($this->request->is('post')) {
			$this->Speaker->set($this->data);
			if($this->Speaker->validates()) {
			
				if($this->data['Speaker']['avatar']['error'] == 0) {
					if($this->Uploadfile->uploadImageWithThumb($this->data['Speaker']['avatar'])) {
						$this->request->data['Speaker']['avatar'] = $this->Uploadfile->lastFileUploaded;
					} else {
						$this->request->data['Speaker']['avatar'] = false;
					}
				} else {
					$this->request->data['Speaker']['avatar'] = false;
				}					
			
				if($this->Speaker->save($this->data,array('validate' => false))) {
						$this->Session->setFlash(__("Referent angelegt!"),'/flash/success');
						$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__("Referent konnte nicht angelegt werden!"),'/flash/success');
				}
			}
		} else {
			$this->set('countSpeakers', $this->Speaker->find('count'));
		}
	}
	
	/**
	 *
	 * manager edit
	 *
	 * add a new speaker
	 */
	public function manager_edit($speakerId = null) {
		if(is_null($speakerId)) $this->redirect(array('action' => 'index'));			
		
		$this->Speaker->id = $speakerId;
		$speaker = $this->Speaker->read();
		
		if(empty($speaker)) {
			$this->Session->setFlash(__("Referent wurde nicht gefunden!"),'/flash/error');
			$this->redirect(array('action' => 'index'));			
		}	
		
		if($this->request->is('post')) {
			
			if($this->data['Speaker']['avatar']['error'] == 0) {
				
				if($speaker['Speaker']['avatar'] != false) {
					unlink(WWW_ROOT.DS.'files'.DS.'speakers'.DS.$speaker['Speaker']['avatar']);
				}
				debug($this->data);
				if($this->Uploadfile->uploadImageWithThumb($this->data['Speaker']['avatar'])) {
					$this->request->data['Speaker']['avatar'] = $this->Uploadfile->lastFileUploaded;
				} else {
					$this->request->data['Speaker']['avatar'] = false;
				}
			} else {
				if($speaker['Speaker']['avatar'] != false) {
					$this->request->data['Speaker']['avatar'] = $speaker['Speaker']['avatar'];
				} else {
					$this->request->data['Speaker']['avatar'] = false;
				}
			}
				
			die;
			$this->Speaker->set($this->data);
			if($this->Speaker->save($this->data)) {
					$this->Session->setFlash(__("Referent angelegt!"),'/flash/success');
					$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__("Referent konnte nicht angelegt werden!"),'/flash/error');
			}			
		} else {		
		
			$this->request->data = $speaker;
		}
	}
	
	/**
	 *
	 * manager delete 
	 */
	public function manager_delete($speakerId = null) {
		if(is_null($speakerId)) $this->redirect(array('action' => 'index'));
		
		if($this->Speaker->delete($speakerId)) {
			$this->Session->setFlash(__("Referent gelöscht!"),'/flash/success');			
		} else {
			$this->Session->setFlash(__("Referent konnte nicht gelöscht werden!"),'/flash/success');
		}
		
		$this->redirect(array('action' => 'index'));
	}
	
	/**
	 *
	 * manager view 
	 */
	public function manager_view($speakerId = null) {
		if(is_null($speakerId)) $this->redirect(array('action' => 'index'));
		
		$this->Speaker->id = $speakerId;
		
		$speaker = $this->Speaker->read();
		
		if(empty($speaker)) {
			$this->Session->setFlash(__("Referent konnte nicht gefunden werden!"),'/flash/success');
			$this->redirect(array('action' => 'index'));
		}
		
		$this->set(compact('speaker'));
	}
	
	/**
	 * nice sorting function for the position of the speakers in any list
	 * but have db action :(
	 */
	public function manager_sorting() {
		if($this->request->is('post')) {
				
			$result = array();
			foreach ($this->data['positions'] as $position => $speaker) {
				$this->Speaker->id = $speaker['id'];
				if(!$this->Speaker->saveField('position', $position)) {					
					$result['result'] = 'Error 500';
					$result['msg'] = "Error On id " . $speaker['id'];
					break;
				} else {
					$result[] = "Speaker mit Id " .  $speaker['id'] . "neue position $position";
					$result['result'] = 'ok';
				}
			}
			
			$this->set(array('response' => $result,
								  '_serialize' => array('response')));
				
		} else {
			$this->set('speakers',$this->Speaker->find('all',array('order' => array('Speaker.position' => 'ASC'))));	
		}		
	}
	
}
	