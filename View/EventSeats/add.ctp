<div class="eventSeats form">
	<?php echo $this->Form->create('EventSeat');?>
		<fieldset>
			<legend><?php echo __('Add Available Seat'); ?></legend>
			<?php echo $this->Form->input('EventSeat.event_venue_id'); ?>
			<?php echo !empty($enumerations) ? $this->Form->input('EventSeat.enumeration_id', array('label' => 'Type of Seat')) : null; ?>
			<?php echo $this->Form->input('EventSeat.name'); ?>
			<?php echo $this->Form->input('EventSeat.description'); ?>
			<?php echo $this->Form->input('EventSeat.ticket_price'); ?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
</div>

<?php
// set contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Event Venues',
		'items' => array(
			$this->Html->link(__('List Seats'), array('action' => 'index')),
			$this->Html->link(__('List Venues'), array('controller' => 'event_venues', 'action' => 'index')),
			$this->Html->link(__('New Venue'), array('controller' => 'event_venues', 'action' => 'add')),
			$this->Html->link(__('List Guests'), array('controller' => 'events_guests', 'action' => 'index')),
			$this->Html->link(__('New Guest'), array('controller' => 'events_guests', 'action' => 'add'))
			)
		),
	)));
