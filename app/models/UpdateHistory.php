<?php

class UpdateHistory extends Eloquent {

	protected $table = 'updatehistories';

	protected $guard = array('id', 'tag', 'created_at', 'updated_at', 'updated_by'); 
}