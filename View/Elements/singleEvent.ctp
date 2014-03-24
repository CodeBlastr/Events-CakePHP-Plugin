	<div class="singleEvent" itemscope itemtype="http://schema.org/Event">
	    <h4>
			<?php echo $this->Html->link(
				$event['Event']['name'],
				array('plugin' => 'events', 'controller' => 'events', 'action' => 'view', $event['Event']['id']),
				array('itemprop' =>'url name'));
			?>
		</h4>
	    <?php echo $this->Text->truncate(strip_tags($event['Event']['description'])); ?>
	    <i class="icon-tag"></i> <?php echo ZuhaInflector::pricify($event['Event']['ticket_price'], array('currency' => 'USD')); ?> &nbsp; <i class="icon-time"></i> <?php echo ZuhaInflector::timify($event['Event']['start']); ?>
	</div>