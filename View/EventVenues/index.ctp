<div class="eventVenues index">
	<h2><?php echo __('Venues');?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('tickets_total');?></th>
			<th><?php echo $this->Paginator->sort('tickets_left');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
		</tr>
		<?php foreach ($eventVenues as $eventVenue) : ?>
			<tr>
				<td><?php echo $this->Html->link($eventVenue['EventVenue']['name'], array('controller' => 'event_venues', 'action' => 'view', $eventVenue['EventVenue']['id'])); ?></td>
				<td><?php echo $this->Text->truncate($eventVenue['EventVenue']['description']); ?></td>
				<td><?php echo h($eventVenue['EventVenue']['tickets_total']); ?></td>
				<td><?php echo h($eventVenue['EventVenue']['tickets_left']); ?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $eventVenue['EventVenue']['id']), array('class' => 'btn btn-xs btn-default')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $eventVenue['EventVenue']['id']), array('class' => 'btn btn-xs btn-default')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $eventVenue['EventVenue']['id']), array('class' => 'btn btn-xs btn-danger'), __('Are you sure you want to delete # %s?', $eventVenue['EventVenue']['id'])); ?>
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
	__('Venues')
)));

// set contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Event Venues',
		'items' => array(
			$this->Html->link(__('New Venue'), array('action' => 'add')),
			$this->Html->link(__('List Events'), array('controller' => 'events', 'action' => 'index')),
			$this->Html->link(__('New Event'), array('controller' => 'events', 'action' => 'add')),
			$this->Html->link(__('List Seats'), array('controller' => 'event_seats', 'action' => 'index')),
			$this->Html->link(__('New Seat'), array('controller' => 'event_seats', 'action' => 'add'))
			)
		),
	)));
