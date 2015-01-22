<?php 

class ActivityCategory extends Eloquent {

    protected $table = 'activity_categories';

    protected $fillable = array('activity_id', 'category_id');

}