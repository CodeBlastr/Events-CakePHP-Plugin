<div class="events index">
	<h2><?php echo __('Events');?></h2>
	<?php if(!empty($events)) : ?>
		<?php
		// index page per user
		$lastDay = '';
		foreach ($events as $event) :
			$currentDay = date('F jS, Y', strtotime($event['Event']['start']));
			if($lastDay !== $currentDay) {
			echo '<hr /><h3>'.($currentDay).'</h3><hr />';
			}

			echo $this->Element('singleEvent', array('event' => $event), array('plugin' => 'events'));

			$lastDay = date('F jS, Y', strtotime($event['Event']['start']));
		endforeach; ?>
	<?php else : ?>
		<p>There are no events currently scheduled.</p>
	<?php endif; ?>
</div>

<?php
// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Events',
		'items' => array(
			$this->Html->link(__('New Event'), array('action' => 'add')),
			$this->Html->link(__('List Event Schedules'), array('controller' => 'event_schedules', 'action' => 'index')),
			$this->Html->link(__('New Event Schedule'), array('controller' => 'event_schedules', 'action' => 'add')),
			$this->Html->link(__('List Event Venues'), array('controller' => 'event_venues', 'action' => 'index')),
			$this->Html->link(__('New Event Venue'), array('controller' => 'event_venues', 'action' => 'add')),
			$this->Html->link(__('List Events Guests'), array('controller' => 'events_guests', 'action' => 'index')),
			$this->Html->link(__('New Guest'), array('controller' => 'events_guests', 'action' => 'add'))
			)
		),
	)));
