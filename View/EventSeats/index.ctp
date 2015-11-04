<div class="eventSeats index">
	<h2><?php echo __('Seats');?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('event_venue_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('ticket_price');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
		</tr>
		<?php foreach ($eventSeats as $eventSeat): ?>
			<tr>
				<td>
					<?php echo $this->Html->link($eventSeat['EventVenue']['name'], array('controller' => 'event_venues', 'action' => 'view', $eventSeat['EventVenue']['id'])); ?>
				</td>
				<td><?php echo h($eventSeat['EventSeat']['name']); ?>&nbsp;</td>
				<td><?php echo h($eventSeat['EventSeat']['description']); ?>&nbsp;</td>
				<td><?php echo h($eventSeat['EventSeat']['ticket_price']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $eventSeat['EventSeat']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $eventSeat['EventSeat']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $eventSeat['EventSeat']['id']), null, __('Are you sure you want to delete %s?', $eventSeat['EventSeat']['name'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php echo $this->element('paging'); ?>
</div>

<?php
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link(__('Admin Dashboard'), '/admin'),
	$this->Html->link(__('Events Dashboard'), array('admin' => true, 'plugin' => 'events', 'controller' => 'events', 'action' => 'dashboard')),
	__('Seats')
)));

// set contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Event Seats',
		'items' => array(
			$this->Html->link(__('New Seat'), array('action' => 'add')),
			$this->Html->link(__('List Venues'), array('controller' => 'event_venues', 'action' => 'index')),
			$this->Html->link(__('New Venue'), array('controller' => 'event_venues', 'action' => 'add')),
			$this->Html->link(__('List Guests'), array('controller' => 'events_guests', 'action' => 'index')),
			$this->Html->link(__('New Guest'), array('controller' => 'events_guests', 'action' => 'add'))
			)
		)
	)));