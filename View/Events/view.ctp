<div class="events view" itemscope itemtype="http://schema.org/Event">
<h2 itemprop="name"><?php  echo h($event['Event']['name']);?></h2>
	
<div class="eventsView_meta">
	<div style="display: inline-block; padding: 20px;">
		<h3>When</h3>
		<div itemprop="startDate" content="<?php echo $event['Event']['start'] ?>">
			<?php echo date('F jS, Y', strtotime($event['Event']['start'])); ?>
		</div>
		<div>
			<?php echo date('g:i a', strtotime($event['Event']['start'])) ?> - <?php echo date('g:i a', strtotime($event['Event']['end'])) ?>
		</div>
	</div>
	<div style="display: inline-block; padding: 20px;" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">
		<h3>Ticket Info</h3>
		<div><span itemprop="lowPrice">$ <?php echo h($event['Event']['ticket_price']); ?></span></div>
		<div><span itemprop="offerCount"><?php echo h($event['Event']['tickets_left']); ?></span> tickets left out of <?php echo h($event['Event']['tickets_total']); ?> total</div>
	</div>
	<div style="display: inline-block; padding: 20px;">
		
	</div>
</div>
<div class="eventsView_description" style="padding: 20px;">
	<?php echo ($event['Event']['description']); ?>
	&nbsp;
</div>

	<dl>
<!--		<dt><?php echo __('Event Schedule'); ?></dt>
		<dd>
			<?php echo $this->Html->link($event['EventSchedule']['id'], array('controller' => 'event_schedules', 'action' => 'view', $event['EventSchedule']['id'])); ?>
			&nbsp;
		</dd>-->

		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($event['Event']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Updated'); ?></dt>
		<dd>
			<?php echo h($event['Event']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Event'), array('action' => 'edit', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Event'), array('action' => 'delete', $event['Event']['id']), null, __('Are you sure you want to delete # %s?', $event['Event']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Events'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Schedules'), array('controller' => 'event_schedules', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Schedule'), array('controller' => 'event_schedules', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Event Venues'), array('controller' => 'event_venues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Event Venue'), array('controller' => 'event_venues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Events Guests'), array('controller' => 'events_guests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Guest'), array('controller' => 'events_guests', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Event Venues');?></h3>
	<?php if (!empty($event['EventVenue'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
		<th><?php echo __('Event Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Tickets Total'); ?></th>
		<th><?php echo __('Tickets Left'); ?></th>
		<th><?php echo __('Ticket Price'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($event['EventVenue'] as $eventVenue): ?>
		<tr>
			<td><?php echo $eventVenue['id'];?></td>
			<td><?php echo $eventVenue['parent_id'];?></td>
			<td><?php echo $eventVenue['lft'];?></td>
			<td><?php echo $eventVenue['rght'];?></td>
			<td><?php echo $eventVenue['event_id'];?></td>
			<td><?php echo $eventVenue['name'];?></td>
			<td><?php echo $eventVenue['description'];?></td>
			<td><?php echo $eventVenue['tickets_total'];?></td>
			<td><?php echo $eventVenue['tickets_left'];?></td>
			<td><?php echo $eventVenue['ticket_price'];?></td>
			<td><?php echo $eventVenue['creator_id'];?></td>
			<td><?php echo $eventVenue['modifier_id'];?></td>
			<td><?php echo $eventVenue['created'];?></td>
			<td><?php echo $eventVenue['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'event_venues', 'action' => 'view', $eventVenue['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'event_venues', 'action' => 'edit', $eventVenue['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'event_venues', 'action' => 'delete', $eventVenue['id']), null, __('Are you sure you want to delete # %s?', $eventVenue['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Event Venue'), array('controller' => 'event_venues', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Events Guests');?></h3>
	<?php if (!empty($event['Guest'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Event Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Event Venue Id'); ?></th>
		<th><?php echo __('Event Seat Id'); ?></th>
		<th><?php echo __('Creator Id'); ?></th>
		<th><?php echo __('Modifier Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($event['Guest'] as $guest): ?>
		<tr>
			<td><?php echo $guest['id'];?></td>
			<td><?php echo $guest['event_id'];?></td>
			<td><?php echo $guest['user_id'];?></td>
			<td><?php echo $guest['email'];?></td>
			<td><?php echo $guest['event_venue_id'];?></td>
			<td><?php echo $guest['event_seat_id'];?></td>
			<td><?php echo $guest['creator_id'];?></td>
			<td><?php echo $guest['modifier_id'];?></td>
			<td><?php echo $guest['created'];?></td>
			<td><?php echo $guest['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'events_guests', 'action' => 'view', $guest['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'events_guests', 'action' => 'edit', $guest['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'events_guests', 'action' => 'delete', $guest['id']), null, __('Are you sure you want to delete # %s?', $guest['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Guest'), array('controller' => 'events_guests', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
