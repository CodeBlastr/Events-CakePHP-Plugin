	<div class="singleEvent" itemscope itemtype="http://schema.org/Event">
	    <h4>
			<?php echo $this->Html->link(
				$event['Event']['name'],
				array('plugin' => 'events', 'controller' => 'events', 'action' => 'view', $event['Event']['id']),
				array('itemprop' =>'url name'));
			?>
		</h4>
	    <?php echo $this->Text->truncate(strip_tags($event['Event']['description'])); ?>
	    <br />
	    <i class="icon-tag"></i> $ <?php echo h($event['Event']['ticket_price']); ?>&nbsp; <i class="icon-time"></i> <?php echo date('g:i a', strtotime($event['Event']['start'])) ?>
	</div>