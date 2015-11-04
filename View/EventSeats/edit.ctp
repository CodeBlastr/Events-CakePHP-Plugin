<div class="eventSeats form">
	<?php echo $this->Form->create('EventSeat');?>
		<fieldset>
			<legend><?php echo __('Edit %s', $this->request->data['EventSeat']['name']); ?></legend>
			<?php echo $this->Form->input('EventSeat.id'); ?>
			<?php echo $this->Form->input('EventSeat.event_venue_id'); ?>
			<?php echo $this->Form->input('EventSeat.enumeration_id'); ?>
			<?php echo $this->Form->input('EventSeat.name'); ?>
			<?php echo $this->Form->input('EventSeat.description'); ?>
			<?php echo $this->Form->input('EventSeat.ticket_price'); ?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
</div>

<?php
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link(__('Events Dashboard'), '/admin/events/events/dashboard'),
	$this->Html->link(__('Venues'), array('admin' => true, 'plugin' => 'events', 'controller' => 'event_venues', 'action' => 'index')),
	__('Edit %s', $this->request->data['EventSeat']['name']),
)));

// set contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Event Venues',
		'items' => array(
			$this->Html->link(__('List Seats'), array('action' => 'index')),
			$this->Html->link(__('Add Seat'), array('action' => 'add')),
			$this->Html->link(__('Delete'), array('action' => 'delete', $this->request->data['EventSeat']['id']), null, __('Are you sure you want to delete %s?', $this->request->data['EventSeat']['name']))
			)
		),
	)));
