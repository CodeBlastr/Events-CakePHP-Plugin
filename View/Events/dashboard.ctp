<div class="users dashboard row">
    <div class="col-md-6 ">
        <h3>Events</h3>
        <table>
            <thead>
            	<th><?php echo $this->Paginator->sort('Event.name', 'Name'); ?></th>
            	<th><?php echo $this->Paginator->sort('Event.start', 'Start Date'); ?></th>
            	<th><?php echo $this->Paginator->sort('Event.end', 'End Date'); ?></th>
            	<th>Actions</th>
            </thead>
            <?php foreach ($events as $event) : ?>
                <tr>
                    <td><?php echo $this->Html->link($event['Event']['name'], array('action' => 'view', $event['Event']['id'])); ?></td>
                    <td><?php echo ZuhaInflector::datify($event['Event']['start']); ?></td>
                    <td><?php echo ZuhaInflector::datify($event['Event']['end']); ?></td>
                    <td>
                        <a class="btn btn-info btn-xs" href="<?php echo $this->Html->url(array('action' => 'edit', $event['Event']['id'])); ?>">
                            <i class="glyphicon glyphicon-edit"></i> Edit
                        </a>
						<?php echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i> Delete', array('action' => 'delete', $event['Event']['id']), array('class' => 'btn btn-danger btn-xs', 'escape' => false), __('Are you sure you want to delete %s?', $event['Event']['name'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php echo $this->element('paging'); ?>
    </div>
    
    <div class="col-md-3">
        <h3>Places</h3>
        <div class="list-group">
	    	<?php foreach ($eventVenues as $venue) : ?>
	    		<div class="list-group-item">
		    		<div class="row">
		    			<div class="col-xs-3">
		    				<?php echo $this->Html->link($this->Attachment->display($venue['FileStorage'][0], array('class' => 'img-thumbnail')), array('controller' => 'event_venues', 'action' => 'view', $venue['EventVenue']['id']), array('escape' => false)); ?>
		    			</div>
		    			<div class="col-xs-9">
		    				<?php echo $this->Html->link($venue['EventVenue']['name'], array('controller' => 'event_venues', 'action' => 'view', $venue['EventVenue']['id'])); ?>
		    			</div>
		    		</div>
		    	</div>
	    	<?php endforeach; ?>
    	</div>
    </div>

    <div class="col-md-3">
        <h3>Quick Links</h3>
        <div class="list-group">
        	<?php echo $this->Html->link('Add Event', array('admin' => true, 'controller' => 'events', 'action' => 'add'), array('class' => 'list-group-item')); ?>
            <?php echo $this->Html->link('Manage Venues', array('admin' => true, 'controller' => 'event_venues', 'action' => 'index'), array('class' => 'list-group-item')); ?>
            <?php echo $this->Html->link('Manage Seats', array('admin' => true, 'plugin' => 'events', 'controller' => 'event_seats', 'action' => 'index'), array('class' => 'list-group-item')); ?>
            <?php // just not sure whether or not this works at the moment // echo $this->Html->link('Bulk Import', array('admin' => true, 'plugin' => 'events', 'controller' => 'events', 'action' => 'import'), array('class' => 'list-group-item')); ?>
        </div>
    </div>
</div>

<?php
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link(__('Admin Dashboard'), '/admin'),
	__('Events Dashboard')
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