<?php
App::uses('EventsAppController', 'Events.Controller');
/**
 * EventGuests Controller
 *
 */
class EventGuestsController extends EventsAppController {

	public $name = 'EventGuests';
	
	public $uses = array('Events.EventGuest');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EventGuest->recursive = 0;
		$this->set('eventGuests', $this->paginate());
	}

}
