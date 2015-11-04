<?php
App::uses('EventsAppModel', 'Events.Model');

/**
 * EventSeat Model
 *
 * @property EventVenue $EventVenue
 * @property Creator $Creator
 * @property Modifier $Modifier
 * @property EventGuest $EventGuest
 */
 
class AppEventSeat extends EventsAppModel {
	
    public $name = 'EventSeat';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'event_venue_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Enumeration' => array(
			'className' => 'Enumeration',
			'foreignKey' => 'enumeration_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'EventVenue' => array(
			'className' => 'Events.EventVenue',
			'foreignKey' => 'event_venue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Creator' => array(
			'className' => 'Users.User',
			'foreignKey' => 'creator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Modifier' => array(
			'className' => 'Users.User',
			'foreignKey' => 'modifier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'EventGuest' => array(
			'className' => 'Events.EventGuest',
			'foreignKey' => 'event_seat_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	// public function __construct($id = false, $table = null, $ds = null) {
		// parent::__construct($id, $table, $ds);
	// }

}

if (!isset($refuseInit)) {
	class EventSeat extends AppEventSeat {}
}
