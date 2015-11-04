<div class="eventSeats view">
	<h2><?php  echo __('Event Seat');?>asdf</h2>
	<dl>
		
		<dt><?php echo __('Event Venue'); ?></dt>
		<dd>
			<?php echo $this->Html->link($eventSeat['EventVenue']['name'], array('controller' => 'event_venues', 'action' => 'view', $eventSeat['EventVenue']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($eventSeat['EventSeat']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($eventSeat['EventSeat']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ticket Price'); ?></dt>
		<dd>
			<?php echo ZuhaInflector::pricify($eventSeat['EventSeat']['ticket_price'], array('currency' => 'USD')); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<?php
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link(__('Admin Dashboard'), '/admin'),
	$this->Html->link(__('Events Dashboard'), '/admin/events/events/dashboard'),
	$this->Html->link(__('Venues'), array('admin' => true, 'plugin' => 'events', 'controller' => 'event_venues', 'action' => 'index')),
	$this->Html->link($eventSeat['EventVenue']['name'], array('controller' => 'event_venues', 'action' => 'view', $eventSeat['EventVenue']['id'])),
	__($eventSeat['EventSeat']['name']),
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
