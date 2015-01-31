<?php 

class News extends Eloquent {

    protected $table = 'news';

    protected $fillable = array('title', 'subtitle', 'content', 'featured_image');

}