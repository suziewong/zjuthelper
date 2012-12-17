<?php
	class Event
	{

		public $id;
		public $uid;
		public $title;

		public $description;

		public $start;

		public $end;

		public function __construct($event)
		{
			if( is_array($event))
			{
				$this->id = $event['event_id'];
				$this->uid = $event['event_uid'];
				$this->title = $event['event_title'];
				$this->description = $event['event_desc'];
				$this->start = $event['event_start'];
				$this->end = $event['event_end'];
			}
			else
			{
				throw new Exception("No event data was supplied");
			}
		}
	}
?>
