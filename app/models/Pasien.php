<?php
class Pasien extends Eloquent{
	
	public $timestamps = false;
	protected $table = 'tbpasien';
	public $primaryKey = 'NoRM';
}