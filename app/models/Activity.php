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

    protected $rules = array(
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

    protected $errors;

    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function getId()
    {
        return $this->id;
    }

}


