<?php namespace App;

use Illuminate\Database\Eloquent\Model,
	App\Item;

class Categories extends Model {

	protected $fillable = ['name', 'description'];

	/**
	 * A category has many items
	 */
	public function items() {
		return $this->hasMany(Item);
	}

}
