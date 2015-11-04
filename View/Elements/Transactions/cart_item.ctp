<?php echo $this->Form->hidden("TransactionItem.{$i}.quantity", array('value' => 1)); ?>
<div class="row">
	<div class="col-xs-1">
		<?php echo $this->Html->link('<span class="glyphicon glyphicon-remove-sign"></span>', array('plugin' => 'transactions', 'controller' => 'transaction_items', 'action' => 'delete', $transactionItem['id']), array('title' => 'Remove from cart', 'escape' => false)); ?>
	</div>
	<div class="col-xs-7">
		<?php echo $transactionItem['name']; ?>
	</div>
	<div class="col-xs-4 text-right">
	    $<span class="floatPrice"><?php echo ZuhaInflector::pricify($transactionItem['price']); ?></span>
	</div>
</div>
<hr>