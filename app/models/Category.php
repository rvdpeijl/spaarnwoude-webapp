<?php 

class Category extends Eloquent {

    protected $table = 'categories';

    protected $fillable = array('activity_id', 'category_id');

}