<div class="events index">
	<h2><?php echo __('Events');?></h2>
	<?php foreach ($events as $event) : ?>
		<div class="row">
			<div class="col-sm-8">
				<h4><?php echo $this->Html->link($event['Event']['name'], array('action' => 'view', $event['Event']['id'])); ?></h4>
				<?php echo $this->Text->truncate($event['Event']['description']); ?>
			</div>
			<div class="col-sm-4 text-right">
				<?php echo $this->Html->link('View', array('action' => 'view', $event['Event']['id']), array('class' => 'btn btn-xs btn-default')); ?></h3>
			</div>
		</div>
		<hr>
	<?php endforeach; ?>
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
			$this->Html->link(__('List Venues'), array('controller' => 'event_venues', 'action' => 'index')),
			$this->Html->link(__('New Venue'), array('controller' => 'event_venues', 'action' => 'add')),
			//$this->Html->link(__('List Events Guests'), array('controller' => 'events_guests', 'action' => 'index')),
			//$this->Html->link(__('New Guest'), array('controller' => 'events_guests', 'action' => 'add')),
			)
		),
	)));