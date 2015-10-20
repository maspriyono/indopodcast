<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model {

	protected $fillable = ['name', 'description'];

	/**
	 * Tags has many items
	 */
	public function items() {
		return $this->belongsToMany('App\Items', 'items_tags', 'tag_id', 'item_id');
	}

}
