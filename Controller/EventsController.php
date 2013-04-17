<?php
App::uses('EventsAppController', 'Events.Controller');
/**
 * Events Controller
 *
 * @property Event $Event
 */
class EventsController extends EventsAppController {

	public $name = 'Events';
	
	public $uses = array('Events.Event');

	//public $helpers = array('Time');
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Event->recursive = 0;
		$this->paginate['conditions'][] = 'Event.start > NOW()';
		$this->paginate['order']['Event.start'] = 'asc';

		$this->set('events', $this->paginate());
	}
	public function my($userId = null) {
		$userId = ($userId) ? $userId : $this->Session->read('Auth.User.id');
		$this->Event->recursive = 0;
		$events = $this->Event->find('all', array(
		    'conditions' => array(
				'Event.start > NOW()',
				'OR' => array(
					'Event.creator_id' => $userId,
					'Event.owner_id' => $userId,
				)
		    ),
		    'order' => array('Event.start' => 'asc')
		));
		// return() the data if it's being used via an element
		if(isset($this->request->params['requested'])) {
		  return $events;
		} else {
		  $this->set('events', $events);
		}
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		$this->set('event', $this->Event->read(null, $id));
		$venueid = $this->Event->data['Event']['event_venue_id'];
		if($venueid !== '') {
			$this->set('eventVenue', $this->Event->EventVenue->read(null, $venueid));
		}
		
	}

/**
 * add method
 *
 * @return void
 */
	public function add($ownerId = null) {
		if ($this->request->is('post')) {
			$this->Event->create();
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
			}
		}
		$user = $this->Auth->user();
		$eventSchedules = $this->Event->EventSchedule->find('list');
		$guests = $this->Event->Guest->find('list');
		$this->set(compact('eventSchedules', 'guests', 'ownerId', 'user'));
	}
	
/**
 * Currently allows one to import Events for another
 * Current AuthUser owns events if an OwnerId is not provided.
 * 
 * @param string $ownerId
 */
	public function import($ownerId = null) {
		
		$this->set('page_title_for_layout', 'Import Events');
		
		if ($this->request->is('post')) {
			$messages = $this->Event->importFromCsv($this->request->data);
			if ( empty($messages['errors']) ) {
				$this->Session->setFlash(implode($messages['messages']));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(implode($messages['errors']));
			}
		}
		
		$this->set('ownerId', !empty($ownerId) ? $ownerId : $this->Auth->user('id'));
		
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Event->read(null, $id);
		}
		$eventSchedules = $this->Event->EventSchedule->find('list');
		$guests = $this->Event->Guest->find('list');
		$eventVenues = $this->Event->EventVenue->find('list');
		
		$event = $this->Event->data;
		$this->set(compact('eventSchedules', 'guests', 'event', 'eventVenues'));
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
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->Event->delete()) {
			$this->Session->setFlash(__('Event deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Event was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
