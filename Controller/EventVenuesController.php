<?php
App::uses('EventsAppController', 'Events.Controller');
/**
 * EventVenues Controller
 *
 * @property EventVenue $EventVenue
 */
class EventVenuesController extends EventsAppController {

    public $name = 'EventVenues';
	
	public $uses = array('Events.EventVenue');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EventVenue->recursive = 0;
		$this->set('eventVenues', $eventVenues = $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->EventVenue->id = $id;
		if (!$this->EventVenue->exists()) {
			throw new NotFoundException(__('Invalid venue'));
		}
		$this->set('events', $this->EventVenue->Event->find('all', array('conditions' => array('Event.event_venue_id' => $id))));
		$this->set('eventVenue', $eventVenue = $this->EventVenue->find('first', array('contain' => array('Event', 'EventSeat'), 'conditions' => array('EventVenue.id' => $id))));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EventVenue->create();
			if ($this->EventVenue->save($this->request->data)) {
				$this->Session->setFlash(__('The venue has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The venue could not be saved. Please, try again.'));
			}
		}
		$parentEventVenues = $this->EventVenue->ParentEventVenue->find('list');
		$events = $this->EventVenue->Event->find('list');
		$this->set(compact('parentEventVenues', 'events'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->EventVenue->id = $id;
		if (!$this->EventVenue->exists()) {
			throw new NotFoundException(__('Invalid event venue'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->EventVenue->save($this->request->data)) {
				$this->Session->setFlash(__('The event venue has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event venue could not be saved. Please, try again.'));
			}
		}
		// $parentEventVenues = $this->EventVenue->ParentEventVenue->find('list'); // just didn't seem necessary (should be used for custom implementations?)
		// $events = $this->EventVenue->Event->find('list'); // just didn't seem necessary (should be used for custom implementations?)
		$this->set('eventVenue', $this->request->data = $eventVenue = $this->EventVenue->find('first', array('conditions' => array('EventVenue.id' => $id))));
		$this->set('page_title_for_layout', __('Edit %s', $this->request->data['EventVenue']['name'])); 
		$this->set('title_for_layout', __('Edit %s', $this->request->data['EventVenue']['name']));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->EventVenue->id = $id;
		if (!$this->EventVenue->exists()) {
			throw new NotFoundException(__('Invalid event venue'));
		}
		if ($this->EventVenue->delete()) {
			$this->Session->setFlash(__('Event venue deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Event venue was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
