<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Slider extends Model
{
    protected $table = 'slider';
	protected  $hidden = ['created_at','updated_at'];
    protected $fillable = [
        'title_ar','title_en','content_ar','content_en','image','price','url'
    ];
    
    public function setImageAttribute($image)
	{
		if (Input::hasFile('image')) {
			//time 
			$time = time();
			// get file extention
			$ext  =Input::file('image')->getClientOriginalExtension();
			//make name as time and extention
			$fullname = $time . '.' . $ext;
			//uplode image to path
			Input::file('image')->move(public_path() .'/uploads/images/sliders', $fullname);
			//get image with path
			$path ='/uploads/images/sliders';
			//upload to thumb path

            // save image name to data base
			$this->attributes['image'] =$path.'/'.$fullname;
		}

	}
}
