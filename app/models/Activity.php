<?php 

class Activity extends Eloquent {

    protected $table = 'activities';

    protected $fillable = array(
    	'name',
    	'organization',
    	'latitude',
    	'longitude',
    	'short_desc',
    	'long_desc',
    	'address',
    	'zipcode',
    	'city',
    	'phone',
    	'website_url',
    	'facebook_url',
    	'twitter_url'
    );

    public static $rules = array(
	    'name'				=>'required|alpha|min:2',
    	'organization'		=>'required|alpha|min:2',
    	'latitude'			=>'required|numeric',
    	'longitude'			=>'required|numeric',
    	'short_desc'		=>'required|min:2|max:150',
    	'long_desc'			=>'required|min:2|max:2000',
    	'address'			=>'required|min:2',
    	'zipcode'			=>'required|alpha_num|size:6',
    	'city'				=>'required|alpha|min:2',
    	'phone'				=>'required|regex:/[0-9 -]{10,11}/',
    	'website_url'		=>'url',
    	'facebook_url'		=>'url',
    	'twitter_url'		=>'url'
    );

    public function validate($input) {

        $rules = array(
            'name'              =>'required|alpha|min:2',
            'organization'      =>'required|alpha|min:2',
            'latitude'          =>'required|numeric',
            'longitude'         =>'required|numeric',
            'short_desc'        =>'required|min:2|max:150',
            'long_desc'         =>'required|min:2|max:2000',
            'address'           =>'required|min:2',
            'zipcode'           =>'required|alpha_num|size:6',
            'city'              =>'required|alpha|min:2',
            'phone'             =>'required|regex:/[0-9 -]{10,11}/',
            'website_url'       =>'url',
            'facebook_url'      =>'url',
            'twitter_url'       =>'url'
        );

        return Validator::make($input, $rules);
    }

}


