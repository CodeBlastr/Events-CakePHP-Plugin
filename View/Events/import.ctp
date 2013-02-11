<?php
echo $this->Html->tag('p', 'Multiple events may be imported at once using a CSV file.');
echo $this->Html->tag('p', 'A CSV is a file of Comma-Separated Values, and can be easily created from any spreadsheet program.');
echo $this->Html->tag('p', $this->Html->link('Download a sample template', '/events/event-import-sample.csv') );

echo $this->Form->create('Event', array('type' => 'file'));
echo $this->Form->hidden('owner_id', $ownerId);
echo $this->Form->file('csv', array('label' => false));
echo $this->Form->submit('Upload & Import');
echo $this->Form->end();
