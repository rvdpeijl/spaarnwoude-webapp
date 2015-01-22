<?php 

class Activity extends Eloquent {

    protected $table = 'activities';

    protected $fillable = array('name', 'organization');

}