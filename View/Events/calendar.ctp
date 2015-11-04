<div class="events index">
	<h2><?php echo __('Events');?></h2>
	<div class="row">
		<div class="col-md-12">
			<?php
			// format calendar data and combine into one array
			foreach ($events as $event) :
				$items[] = array(
					'id' => $event['Event']['id'],
					'title' => __('%s', $event['Event']['name']),
					'allDay' => false,
					'start' => date('c', strtotime($event['Event']['start'])),
					'end' => date('c', strtotime($event['Event']['end'])),
					'url' => '/events/events/view/' . $event['Event']['id'],
					'className' => 'event',
					'color' => '#0d729a'
				);
			endforeach;
			echo $this->Calendar->renderCalendar(array('data' => json_encode($items))); ?>
		</div>
	</div>
	<hr>
	<?php echo $this->element('paging'); ?>
</div>

<?php
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link(__('Admin Dashboard'), '/admin'),
	__('Events')
)));

// set contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Events',
		'items' => array(
			$this->Html->link(__('New Event'), array('action' => 'add')),
		    //$this->Html->link(__('List Event Schedules'), array('controller' => 'event_schedules', 'action' => 'index')),
			//$this->Html->link(__('New Event Schedule'), array('controller' => 'event_schedules', 'action' => 'add')),
			$this->Html->link(__('List Event Venues'), array('controller' => 'event_venues', 'action' => 'index')),
			$this->Html->link(__('New Event Venue'), array('controller' => 'event_venues', 'action' => 'add')),
			//$this->Html->link(__('List Events Guests'), array('controller' => 'events_guests', 'action' => 'index')),
			//$this->Html->link(__('New Guest'), array('controller' => 'events_guests', 'action' => 'add')),
			)
		),
	)));