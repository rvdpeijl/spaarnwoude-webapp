<?php 

class AgendaCategory extends Eloquent {

    protected $table = 'agenda_categories';

    protected $fillable = array('agenda_id', 'category_id');

}