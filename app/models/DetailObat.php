<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class DetailObat extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	public $timestamps = false;
	protected $table = 'apo_penjualan_detail';
}
