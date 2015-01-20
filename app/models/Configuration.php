<?php

class Configuration extends Eloquent {

	protected $table = 'configurations';

	protected $guard = array('id', 'configure_name', 'created_by');

	protected $fillable = array('configure_value', 'configure_by' ,'updated_by');

}