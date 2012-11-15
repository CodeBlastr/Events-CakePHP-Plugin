<div class="events index">
	<h2><?php echo __('Events');?></h2>

	<?php
	if(!empty($events)) {
		// index page per user
		$lastDay = '';
		foreach ($events as $event) {
			$currentDay = date('F jS, Y', strtotime($event['Event']['start']));
			if($lastDay !== $currentDay) {
			echo '<hr /><h3>'.($currentDay).'</h3><hr />';
			}

			echo $this->Element('singleEvent', array('event' => $event), array('plugin' => 'events'));

			$lastDay = date('F jS, Y', strtotime($event['Event']['start']));
		} // foreach($event)
	} else {
		echo '<p>There are no events currently scheduled.';
	}
	?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Event'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Event Schedules'), array('controller' => 'event_schedules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Schedule'), array('controller' => 'event_schedules', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Venues'), array('controller' => 'event_venues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Venue'), array('controller' => 'event_venues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events Guests'), array('controller' => 'events_guests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Guest'), array('controller' => 'events_guests', 'action' => 'add')); ?> </li>
	</ul>
</div>
