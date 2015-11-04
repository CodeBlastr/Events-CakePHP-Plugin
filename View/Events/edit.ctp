<div class="events form">
	 <?php echo $this->Form->create('Event'); ?>
		<fieldset>
			<legend><?php echo __('Edit %s', $this->request->data['Event']['name']); ?></legend>
			<?php echo $this->Form->input('Event.id'); ?>
			<?php echo $this->Form->input('Event.name'); ?>
			<?php echo $this->Form->input('Event.event_venue_id'); ?>
			<?php echo $this->Form->input('Event.description', array('type' => 'richtext')); ?>
			<?php echo $this->Form->input('Event.start', array('type' => 'datetimepicker')); ?>
			<?php echo $this->Form->input('Event.end', array('type' => 'datetimepicker')); ?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
</div>

<?php // echo $this->Element('thumb_edit', array('model' => 'Event', 'foreignKey' => $event['Event']['id']), array('plugin' => 'Galleries')); // commented out on finlife, should use FileStorage instead ?>

<?php
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link(__('Admin Dashboard'), '/admin'),
	$this->Html->link(__('Events Dashboard'), array('admin' => true, 'plugin' => 'events', 'controller' => 'events', 'action' => 'dashboard')),
	__('Edit %s', $this->request->data['Event']['name']),
)));

// set contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Event',
		'items' => array(
			$this->Html->link(__('List Events'), array('action' => 'index')),
			$this->Html->link(__('List Venues'), array('controller' => 'event_venues', 'action' => 'index')),
			$this->Html->link(__('New Venue'), array('controller' => 'event_venues', 'action' => 'add')),
			$this->Html->link(__('List Guests'), array('controller' => 'events_guests', 'action' => 'index')),
			$this->Html->link(__('New Guest'), array('controller' => 'events_guests', 'action' => 'add')),
			$this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Event.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Event.id')))
			)
		),
	)));
