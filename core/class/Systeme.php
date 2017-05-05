<?php
class System {

	public $domain;
	public $db;

	function __construct($db,$domain)
	{
		$this->db = $db;
		$this->domain = $domain;
	}

	public function getDomain() {
		return $this->domain;
	}
	public function timeAgo($lang,$ptime) {
		$etime = time() - $ptime;
		if ($etime < 1)
		{
			return $lang['just_now'];
		}
		$a = array( 365 * 24 * 60 * 60  =>  $lang['year'],
			30 * 24 * 60 * 60  =>  $lang['month'],
			24 * 60 * 60  =>  $lang['day'],
			60 * 60  =>  $lang['hour'],
			60  =>  $lang['minute'],
			1  =>  $lang['second']
			);
		$a_plural = array( 'year'   => $lang['years'],
			'month'  => $lang['months'],
			'day'    => $lang['days'],
			'hour'   => $lang['hours'],
			'minute' => $lang['minutes'],
			'second' => $lang['seconds']
			);

		foreach ($a as $secs => $str)
		{
			$d = $etime / $secs;
			if ($d >= 1)
			{
				$r = round($d);
				return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str).' '.$lang['ago'];
			}
		}
	}