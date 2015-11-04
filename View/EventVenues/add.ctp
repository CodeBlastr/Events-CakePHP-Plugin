<div class="eventVenues form">
	<?php echo $this->Form->create('EventVenue', array('type' => 'file'));?>
		<fieldset>
			<legend><?php echo __('Add Event Venue'); ?></legend>
			<?php // should be a custom case where you would need this // echo $this->Form->input('parent_id'); ?>
			<?php // should be a custom case where you would need this // echo $this->Form->input('event_id'); ?>
			<?php echo $this->Form->input('EventVenue.name'); ?>
			<?php echo $this->Form->input('File.0.file', array('type' => 'file', 'label' => 'Venue Image')); ?>
			<?php echo $this->Form->input('EventVenue.description'); ?>
			<?php echo $this->Form->input('EventVenue.tickets_total', array('label' => __('Number of Tickets Available in Total <small class="text-muted">(Only used if no seats are created for this venue)</small>'))); ?>
			<?php echo $this->Form->input('EventVenue.tickets_left', array('label' => __('Number of Tickets Left <small class="text-muted">(Only used if no seats are created for this venue)</small>'))); ?>
			<?php echo $this->Form->input('EventVenue.ticket_price', array('label' => __('Default Price <small class="text-muted">(Overridden by event price, and seat price)</small>'))); ?>	
		</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
</div>

<?php
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link('Admin Dashboard', '/admin'),
	$this->Html->link(__('Events Dashboard'), array('admin' => true, 'plugin' => 'events', 'controller' => 'events', 'action' => 'dashboard')),
	'Add Venue'
)));

// set contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Event Venues',
		'items' => array(
			$this->Html->link(__('List Venues'), array('controller' => 'event_venues', 'action' => 'index')),
			$this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')),
			$this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')),
			$this->Html->link(__('List Guests'), array('controller' => 'events_guests', 'action' => 'index')),
			$this->Html->link(__('New Guest'), array('controller' => 'events_guests', 'action' => 'add')),
			$this->Html->link(__('List Seats'), array('controller' => 'event_seats', 'action' => 'index')),
			$this->Html->link(__('New Seat'), array('controller' => 'event_seats', 'action' => 'add'))			
			)
		),
	)));
