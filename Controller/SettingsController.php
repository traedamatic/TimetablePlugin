<?php
/**
 * SettingsController
 *
 *  
 * @author Nicolas Traeder <traeder@codebiltiy.com>
 * @package Timetable
 * @license MIT
 * @version 0.1
 */

class SettingsController extends TimetableAppController {
	
	/**
	 * @var string controller name
	 *
	 */
	public $name = "Settings";
	
	/**
	 *
	 * a little Settings page for the timetable
	 */
	public function manager_index() {
		$setting = $this->Setting->find('first');
		
		if(!empty($setting)) {
			$this->request->data = $setting;			
			$this->set('themes', $this->Setting->getThemes());
		} else {			
			$this->request->data = $this->Setting->defaultSettings;
			$this->set('themes', $this->Setting->getThemes());
		}
		
	}
	
	/**
	 *
	 * manager add
	 *
	 * add a new event
	 */
	public function manager_save() {
		if($this->request->is('post')) {			
			if(isset($this->data['Setting']['_id']))
				$this->Setting->id = $this->data['Setting']['_id'];
			
			if($this->Setting->save($this->data)) {
					$this->Session->setFlash(__("Einstellungen gespeichert!"),'/flash/success');
					$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__("Einstellungen konnte nicht angelegt werden!"),'/flash/success');
				$this->redirect(array('action' => 'index'));
			}			
		} else {
			$this->redirect(array('action' => 'index'));
		}
			
	}
	
}