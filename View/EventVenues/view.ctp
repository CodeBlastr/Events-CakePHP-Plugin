<div class="eventVenues view">
	<h2><?php echo $eventVenue['EventVenue']['name']; ?></h2>
	<div class="row">
		<div class="col-sm-6">
			<div class="row">
				<div class="col-sm-4">
					<?php echo $this->Attachment->display($eventVenue['FileStorage'][0], array('class' => 'img-thumbnail')); ?>
				</div>
				<div class="col-sm-8">
					<?php echo $eventVenue['EventVenue']['description']; ?>
					<?php echo $eventVenue['EventVenue']['street']; ?>
					<?php echo $eventVenue['EventVenue']['city']; ?>
					<?php echo $eventVenue['EventVenue']['state']; ?>
					<?php echo $eventVenue['EventVenue']['country']; ?>
					<?php echo $eventVenue['EventVenue']['postal']; ?>
				</div>
			</div>
			
		</div>
		<div class="col-sm-3">
			<h4>Event(s) at <?php echo $eventVenue['EventVenue']['name']; ?></h4>
			<?php foreach ($eventVenue['Event'] as $event) : ?>
				<div class="row">
					<div class="col-xs-8">
						<?php echo $this->Html->link($event['name'], array('controller' => 'events', 'action' => 'view', $event['id'])); ?>		
					</div>
					<div class="col-xs-4 text-right">
						<?php echo ZuhaInflector::datify($event['start']); ?>
					</div>
				</div>
				
			<?php endforeach; ?>
		</div>
		<div class="col-sm-3">
			<h4>Seats at <?php echo $eventVenue['EventVenue']['name']; ?></h4>
			<?php foreach ($eventVenue['EventSeat'] as $eventSeat) : ?>
				<div class="row">
					<div class="col-xs-8">
						<?php echo $this->Html->link($eventSeat['name'], array('controller' => 'event_seats', 'action' => 'view', $eventSeat['id'])); ?>		
					</div>
					<div class="col-xs-4 text-right">
						<?php echo ZuhaInflector::pricify($eventSeat['ticket_price'], array('currency' => 'USD')); ?>
					</div>
				</div>
				
			<?php endforeach; ?>
		</div>
	</div>
</div>

<?php
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link('Admin Dashboard', '/admin'),
	$this->Html->link(__('Events Dashboard'), array('admin' => true, 'plugin' => 'events', 'controller' => 'events', 'action' => 'dashboard')),
	$this->Html->link(__('Venues'), array('admin' => true, 'plugin' => 'events', 'controller' => 'event_venues', 'action' => 'index')),
	$eventVenue['EventVenue']['name']
)));

// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Events',
		'items' => array(
			$this->Html->link(__('List Event Venues'), array('action' => 'index')),
			$this->Html->link(__('New Venue'), array('action' => 'add')),
			$this->Html->link(__('Edit Venue'), array('action' => 'edit', $eventVenue['EventVenue']['id'])),
			$this->Form->postLink(__('Delete Venue'), array('action' => 'delete', $eventVenue['EventVenue']['id']), null, __('Are you sure you want to delete %s?', $eventVenue['EventVenue']['name'])),
			$this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')),
			$this->Html->link(__('List Seats'), array('controller' => 'event_seats', 'action' => 'index')),
			$this->Html->link(__('New Seat'), array('controller' => 'event_seats', 'action' => 'add'))
			)
		),
	)));