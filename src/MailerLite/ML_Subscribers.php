<?php

namespace MailerLite;
	
class ML_Subscribers extends Base\Rest {

	public function __construct($apiKey)
	{
		$this->name = 'subscribers';
		parent::__construct($apiKey);
	}

	public function add($subscriber = null, $resubscribe = 0)
	{
		$subscriber['resubscribe'] = $resubscribe;
		return $this->execute('POST', $subscriber);
	}

	function addAll($subscribers, $resubscribe = 0)
	{
		$data['resubscribe'] = $resubscribe;
		$data['subscribers'] = $subscribers;
		$this->path .= 'import/';
		return $this->execute('POST', $data);
	}

	public function get($email = null, $history = 0)
	{
		$this->setId(null);
		$this->path .= '?email=' . urlencode($email);
		if ($history)
		{
			$this->path .= '&history=1';
		}
		return $this->execute('GET');
	}

	public function remove($email = null)
	{
		$this->path .= '?email=' . urlencode($email);
		return $this->execute('DELETE');
	}

	public function unsubscribe($email)
	{
		$previous_id = $this->id;
		$this->setId( null );

		$this->path .= 'unsubscribe/?email=' . urlencode($email);

		$this->setId( $previous_id );

		return $this->execute('POST');
	}

}
