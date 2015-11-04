<div class="events form">
    <?php echo $this->Form->create('Event', array('type' => 'file')); ?>
    <fieldset>
		<legend><?php echo __('Add Event'); ?> <?php echo $this->Html->link('Import Multiple Events', array('plugin' => 'events', 'controller' => 'events', 'action' => 'import'), array('class' => 'btn btn-mini btn-xs btn-default pull-right')); ?></legend>
		<?php echo $this->Form->input('Event.name'); ?>
		<?php echo $this->Form->input('Event.description', array('type' => 'richtext')); ?>
		<?php echo CakePlugin::loaded('Media') ? __('<hr>%s<hr>', $this->Element('Media.selector', array('media' => $this->request->data['Media'], 'multiple' => true))): null; ?>
		<?php // maybe sometime in the future // echo $this->Form->input('Event.event_schedule_id'); ?>
		<?php echo $this->Form->input('Event.start', array('type' => 'datetimepicker')); ?>
		<?php echo $this->Form->input('Event.end', array('type' => 'datetimepicker')); ?>
		<?php // echo $this->Form->input('Event.tickets_total'); // commented out on findlife, doesn't seem like anyone would need this here ?>
		<?php // echo $this->Form->input('Event.tickets_left'); // commented out on findlife, doesn't seem like anyone would need this here ?>
		<?php echo $this->Form->input('Event.ticket_price', array('label' => __('Default Ticket Price <small class="text-muted">(Only used if no seats are created for this venue)</small>'))); ?>
		<?php echo !empty($ownerId) ? $this->Form->hidden('Event.owner_id', array('value' => $ownerId)) : null; ?>
		<?php // echo $this->Form->input('Guest'); // commented out on findlife, doesn't seem like anyone would need this here ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>


<?php
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link('Admin Dashboard', '/admin'),
	$this->Html->link(__('Events Dashboard'), array('admin' => true, 'plugin' => 'events', 'controller' => 'events', 'action' => 'dashboard')),
	__('Add Event')
)));

// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Events',
		'items' => array(
			$this->Html->link(__('List'), array('action' => 'index')),
			$this->Html->link(__('List Venues'), array('controller' => 'event_venues', 'action' => 'index')),
			$this->Html->link(__('New Venue'), array('controller' => 'event_venues', 'action' => 'add')),
			$this->Html->link(__('List Guests'), array('controller' => 'events_guests', 'action' => 'index')),
			$this->Html->link(__('New Guest'), array('controller' => 'events_guests', 'action' => 'add'))
			)
		),
	)));