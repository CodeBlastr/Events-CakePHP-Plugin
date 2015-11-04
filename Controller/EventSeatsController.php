<?php
App::uses('EventsAppController', 'Events.Controller');

/**
 * EventSeats Controller
 *
 * @property EventSeat $EventSeat
 */
class EventSeatsController extends EventsAppController {

	public $name = 'EventSeats';

	public $uses = 'Events.EventSeat';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EventSeat->recursive = 0;
		$this->set('eventSeats', $eventSeats = $this->paginate()); // shows webpages for some reason
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->EventSeat->id = $id;
		if (!$this->EventSeat->exists()) {
			throw new NotFoundException(__('Invalid event seat'));
		}
		$this->set('eventSeat', $this->EventSeat->find('first', array('contain' => array('EventVenue'), 'conditions' => array('EventSeat.id' => $id))));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EventSeat->create();
			if ($this->EventSeat->save($this->request->data)) {
				$this->Session->setFlash(__('The event seat has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event seat could not be saved. Please, try again.'));
			}
		}
		$this->set('eventVenues', $eventVenues = $this->EventSeat->EventVenue->find('list'));
		$this->set('enumerations', $enumerations = $this->EventSeat->Enumeration->find('list', array('conditions' => array('Enumeration.type' => 'EVENTSEAT'))));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->EventSeat->id = $id;
		if (!$this->EventSeat->exists()) {
			throw new NotFoundException(__('Invalid event seat'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->EventSeat->save($this->request->data)) {
				$this->Session->setFlash(__('The event seat has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event seat could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->EventSeat->read(null, $id);
		}
		$this->set('eventVenues', $eventVenues = $this->EventSeat->EventVenue->find('list'));
		$this->set('enumerations', $enumerations = $this->EventSeat->Enumeration->find('list', array('conditions' => array('Enumeration.type' => 'EVENTSEAT'))));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		// if (!$this->request->is('post')) {
			// throw new MethodNotAllowedException();
		// }
		$this->EventSeat->id = $id;
		if (!$this->EventSeat->exists()) {
			$this->Session->setFlash(__('Invalid event seat'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->EventSeat->delete()) {
			$this->Session->setFlash(__('Event seat deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Event seat was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
