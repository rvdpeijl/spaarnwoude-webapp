<?php 

class Agenda extends Eloquent {

    protected $table = 'agenda';

    protected $fillable = array('name', 'start', 'end','address','city','zipcode');

}