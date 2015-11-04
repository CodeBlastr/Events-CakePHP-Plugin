<?php
App::uses('EventsAppController', 'Events.Controller');
/**
 * Events Controller
 *
 * @property Event $Event
 */
class AppEventsController extends EventsAppController {

	public $name = 'Events';
	
	public $uses = array('Events.Event');
	
	public function __construct($request = null, $response = null) {
		if (CakePlugin::loaded('Ratings')) {
			$this->helpers[] = 'Ratings.Rating';
		}
		parent::__construct($request, $response);
	}
	
/**
 * Index method
 *
 * @return void
 */
	public function dashboard() {
		$this->Event->recursive = 0;
		$this->paginate['order']['Event.start'] = 'DESC';
		$this->set('events', $this->paginate());
		$this->set('eventVenues', $eventVenues = $this->Event->EventVenue->find('all'));
	}

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->Event->recursive = 0;
		$this->paginate['conditions'][] = 'Event.start > NOW()';
		$this->paginate['order']['Event.start'] = 'ASC';
		$this->set('events', $events = $this->paginate());
		$this->set('eventVenues', $eventVenues = Set::combine($this->Event->EventVenue->find('all', array('conditions' => array('EventVenue.id' => Set::extract('/Event/event_venue_id', $events)))), '{n}.EventVenue.id', '{n}'));
		
		// get the venues
		$eventVenues = Set::combine($this->Event->EventVenue->find('all', array('contain' => array('EventSeat'), 'conditions' => array('EventVenue.id' => Set::extract('/Event/event_venue_id', $events)))), '{n}.EventVenue.id', '{n}');
		// add high and low pricing to the venue for easier display 
		foreach ($eventVenues as $id => $venue) {
			$prices = Set::extract('/ticket_price', $venue['EventSeat']);
			$prices = array_unique(array_filter(array_merge($prices, Set::extract('/non_diver_price', $venue['EventSeat']))));
			asort($prices);
			$eventVenues[$id]['EventVenue']['_low_price'] = current($prices);
			$eventVenues[$id]['EventVenue']['_high_price'] = end($prices);
		}
		$this->set('eventVenues', $eventVenues);
	}

/**
 * Archived method
 * 
 * Shows events that have already run.
 * 
 * @return void
 */
	public function archived() {
		$this->Event->recursive = 0;
		$this->paginate['conditions'][] = 'Event.start < NOW()';
		$this->paginate['order']['Event.start'] = 'ASC';
		$this->paginate['contain'] = array('EventVenue');
		$this->set('events', $events = $this->paginate());
		
		// get the venues
		$eventVenues = Set::combine($this->Event->EventVenue->find('all', array('contain' => array('EventSeat'), 'conditions' => array('EventVenue.id' => Set::extract('/Event/event_venue_id', $events)))), '{n}.EventVenue.id', '{n}');
		// add high and low pricing to the venue for easier display 
		foreach ($eventVenues as $id => $venue) {
			$prices = Set::extract('/ticket_price', $venue['EventSeat']);
			$prices = array_unique(array_filter(array_merge($prices, Set::extract('/non_diver_price', $venue['EventSeat']))));
			asort($prices);
			$eventVenues[$id]['EventVenue']['_low_price'] = current($prices);
			$eventVenues[$id]['EventVenue']['_high_price'] = end($prices);
		}
		$this->set('eventVenues', $eventVenues);
	}

/**
 * Calendar method
 *
 * @return void
 */
	public function calendar() {
		$this->Event->recursive = 0;
		$this->paginate['conditions'][] = 'Event.start > NOW()';
		$this->paginate['order']['Event.start'] = 'asc';
		$this->set('events', $this->paginate());
	}
	
/**
 * My method
 * 
 * @param mixed $userId
 */
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
			'contain' => array('EventVenue'),
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
		$event = $this->Event->find('first', array('conditions' => array('Event.id' => $id)));
		$venueId = $event['Event']['event_venue_id'];
		if ($venueid !== '') {
			// didn't use contain because we want the behaviors attached to EventVenue to work
			$this->set('eventVenue', $eventVenue = $this->Event->EventVenue->find('first', array('conditions' => array('EventVenue.id' => $venueId), 'contain' => array('EventSeat'))));
		}
		$this->set('event', $this->request->data = $event = array_merge($event, $eventVenue));
		$this->set('title_for_layout', $this->Event->data['Event']['name'] . ' < Events | ' . __SYSTEM_SITE_NAME);
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
				$this->redirect(array('action' => 'dashboard'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
			}
		}
		$this->set('eventVenues', $eventVenues = $this->Event->EventVenue->find('list'));
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
				$this->redirect(array('action' => 'dashboard'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Event->read(null, $id);
		}
		$this->set('eventVenues', $eventVenues = $this->Event->EventVenue->find('list'));
		$this->set('event', $event = $this->Event->data);
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
}

if (!isset($refuseInit)) {
	class EventsController extends AppEventsController {}
}