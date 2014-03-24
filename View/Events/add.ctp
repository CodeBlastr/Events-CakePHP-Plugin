<div class="events form">
    <?php echo $this->Form->create('Event', array('type' => 'file')); ?>
    <fieldset>
		<legend><?php echo __('Add Event'); ?> <?php echo $this->Html->link('Import Multiple Events', array('plugin' => 'events', 'controller' => 'events', 'action' => 'import'), array('class' => 'btn btn-mini btn-xs btn-default pull-right')); ?></legend>
		<?php echo $this->Form->input('Event.name'); ?>
		<?php echo $this->Form->input('Event.description', array('type' => 'richtext')); ?>
		<?php echo CakePlugin::loaded('Media') ? __('<hr>%s<hr>', $this->Element('Media.selector', array('media' => $this->request->data['Media'], 'multiple' => true))): null; ?>
		<?php echo $this->Form->input('Event.event_schedule_id'); ?>
		<?php echo $this->Form->input('Event.start', array('type' => 'datetimepicker')); ?>
		<?php echo $this->Form->input('Event.end', array('type' => 'datetimepicker')); ?>
		<?php echo $this->Form->input('Event.tickets_total'); ?>
		<?php echo $this->Form->input('Event.tickets_left'); ?>
		<?php echo $this->Form->input('Event.ticket_price'); ?>
		<?php echo $this->Form->input('Event.is_public'); ?>
		<?php echo !empty($ownerId) ? $this->Form->hidden('Event.owner_id', array('value' => $ownerId)) : null; ?>
		<?php echo $this->Form->input('Guest'); ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>


<?php
// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Events',
		'items' => array(
			$this->Html->link(__('List'), array('action' => 'index')),
			$this->Html->link(__('List Event Schedules'), array('controller' => 'event_schedules', 'action' => 'index')),
			$this->Html->link(__('New Event Schedule'), array('controller' => 'event_schedules', 'action' => 'add')),
			$this->Html->link(__('List Event Venues'), array('controller' => 'event_venues', 'action' => 'index')),
			$this->Html->link(__('New Event Venue'), array('controller' => 'event_venues', 'action' => 'add')),
			$this->Html->link(__('List Events Guests'), array('controller' => 'events_guests', 'action' => 'index')),
			$this->Html->link(__('New Guest'), array('controller' => 'events_guests', 'action' => 'add'))
			)
		),
	)));

