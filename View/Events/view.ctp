<div class="events view" itemscope itemtype="http://schema.org/Event">
	<h2 itemprop="name"><?php  echo h($event['Event']['name']);?></h2>
	<div class="row">
		<div class="col-md-12">
			<?php echo ($event['Event']['description']); ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-6">
			<h4>When</h4>
			<div itemprop="startDate" content="<?php echo $event['Event']['start'] ?>">
				<?php echo date('F jS, Y', strtotime($event['Event']['start'])); ?>
			</div>
			<div>
				<?php echo ZuhaInflector::timify($event['Event']['start']); ?> - <?php echo ZuhaInflector::timify($event['Event']['end']); ?>
			</div>
		</div>
		<?php if (!empty($event['Event']['ticket_price'])) : ?>
		<div class="col-sm-6" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">
			<h4>Ticket Info</h4>
			<span itemprop="lowPrice"><?php echo ZuhaInflector::pricify($event['Event']['ticket_price']); ?></span>
			<span itemprop="offerCount"><?php echo $event['Event']['tickets_left']; ?></span> tickets left out of <?php echo h($event['Event']['tickets_total']); ?> total
		</div>
		<?php endif; ?>
	</div>
</div>

<?php
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link(__('Events'), '/events'),
	$event['Event']['name']
)));
// set contextual menu items
$this->set('context_menu', array('menus' => array(
		array(
			'heading' => 'Events',
			'items' => array(
				$this->Html->link(__('List'), array('action' => 'index')),
				$this->Html->link(__('Edit'), array('action' => 'edit', $event['Event']['id'])),
				$this->Form->postLink(__('Delete'), array('controller'=> 'events', 'action' => 'delete', $event['Event']['id']), null, __('Are you sure you want to delete event %s?', $event['Event']['id'])),
			    //$this->Html->link(__('List Event Schedules'), array('controller' => 'event_schedules', 'action' => 'index')),
				//$this->Html->link(__('New Event Schedule'), array('controller' => 'event_schedules', 'action' => 'add')),
				//$this->Html->link(__('List Event Venues'), array('controller' => 'event_venues', 'action' => 'index')),
				//$this->Html->link(__('New Event Venue'), array('controller' => 'event_venues', 'action' => 'add')),
				//$this->Html->link(__('List Events Guests'), array('controller' => 'events_guests', 'action' => 'index')),
				//$this->Html->link(__('New Guest'), array('controller' => 'events_guests', 'action' => 'add')),
		)
	)
)));
