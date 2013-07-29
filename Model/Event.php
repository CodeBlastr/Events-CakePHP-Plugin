<?php

App::uses('EventsAppModel', 'Events.Model');

/**
 * Event Model
 *
 * @property EventSchedule $EventSchedule
 * @property Creator $Creator
 * @property Modifier $Modifier
 * @property EventVenue $EventVenue
 * @property Guest $Guest
 */
class Event extends EventsAppModel {

	public $name = 'Event';
	
	public $actsAs = array('Metable', 'Galleries.Mediable');
	
	public $caller = '';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'event_schedule_id' => array(
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
		'is_public' => array(
			'boolean' => array(
				'rule' => array('boolean'),
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
		'EventVenue' => array(
			'className' => 'Events.EventVenue',
			'foreignKey' => 'event_venue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'EventSchedule' => array(
			'className' => 'Events.EventSchedule',
			'foreignKey' => 'event_schedule_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Owner' => array(
			'className' => 'Users.User',
			'foreignKey' => 'owner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Guest' => array(
			'className' => 'Events.EventsGuests',
			'joinTable' => 'events_guests',
			'foreignKey' => 'event_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

	public function beforeFind($queryData) {
		parent::beforeFind($queryData);
	}
	
	
	/**
	 * @todo Is this variable proposal a good idea?
	 * 
	 * @param array $options
	 */
	public function beforeSave($options = array()) {
		
		switch ($this->caller) {
			case 'import':
				$settings['groupOwnerCanImport'] = defined('__EVENTS_GROUP_OWNER_CAN_IMPORT') ? unserialize(__EVENTS_GROUP_OWNER_CAN_IMPORT) : null;
				if ( $settings['groupOwnerCanImport'] ) {
					// check to see if this person is allowed to import this
//					debug($this->data);
//					die();
				}

				break;

			default:
				break;
		}
		
		

		parent::beforeSave($options);
	}

/**
 * This trims an object, formats it's values if you need to, and returns the data to be merged with the Transaction data.
 * It is a required function for models that will be for sale via the Transactions Plugin.
 * 
 * @param string $foreignKey
 * @return array The necessary fields to add a Transaction Item
 */
	public function mapTransactionItem($foreignKey) {

		$itemData = $this->find('first', array('conditions' => array('id' => $foreignKey)));

		$fieldsToCopyDirectly = array('name');

		foreach ($itemData['Event'] as $k => $v) {
			if (in_array($k, $fieldsToCopyDirectly)) {
				$return['TransactionItem'][$k] = $v;
			}
		}

		return $return;
	}

/**
 * Import
 * 
 * Note: To avoid having to tweak the contents of $csvData,
 * you should use your db field names as the heading names.
 * eg: Event.id, Event.title, Event.description
 * 
 * @param array $data
 * @return type
 * @todo Make sure fopen can't be hacked, it's the main point of entry for the base64 attack.
 */
	function importFromCsv($data) {
		
		$this->caller = 'import';
		
		if ( $data['Import']['csv']['error'] !== UPLOAD_ERR_OK ) {
			return array('errors' => 'We did not receive your file. Please try again.');
		}
		
		// open the file
		$handle = fopen($data['Import']['csv']['tmp_name'], "r");

		// read the 1st row as headings
		$header = fgetcsv($handle);

		// create a message container
		$return = array(
			'messages' => array(),
			'errors' => array(),
		);

		// read each data row in the file
		while ( ($row = fgetcsv($handle)) !== FALSE ) {
			$i++;
			$csvData = array();

			// for each header field 
			foreach ($header as $k => $head) {
				// get the data field from Model.field
				if (strpos($head, '.') !== false) {
					$h = explode('.', $head);
					$csvData[$h[0]][$h[1]] = (isset($row[$k])) ? $row[$k] : '';
				}
				// get the data field from field
				else {
					$csvData[$this->alias][$head] = (isset($row[$k])) ? $row[$k] : '';
					$csvData[$this->alias]['owner_id'] = $data['Import']['owner_id'];
				}
			}

			// see if we have an id             
			$id = isset($csvData[$this->alias]['id']) ? $csvData[$this->alias]['id'] : 0;

			// we have an id, so we update
			if ($id) {
				// there is 2 options here, 
				// option 1:
				// load the current row, and merge it with the new data
				//$this->recursive = -1;
				//$event = $this->read(null,$id);
				//$csvData['Event'] = array_merge($event['Event'],$csvData['Event']);
				// option 2:
				// set the model id
				$this->id = $id;
			}

			// or create a new record
			else {
				$this->create();
			}

			// see what we have
			// debug($csvData);
			
			// validate the row
			$this->set($csvData);
			if ( !$this->validates() ) {
				//$this->_flash( 'warning');
				$return['errors'][] = __(sprintf('Event for Row %d failed to validate.', $i), true);
			}

			// save the row
			if ( !$this->save($data) ) {
				$return['errors'][] = __(sprintf('Event for Row %d failed to save.', $i), true);
			}

			// success message!
			if ( !$error ) {
				$return['messages'][] = __(sprintf('Event for Row %d was saved.', $i), true);
			}
		}

		// close the file
		fclose($handle);

		// return the messages
		return $return;
	}


}
