<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Tindakan extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	public $timestamps = false;
	protected $table = 'tbtindakan';
}
