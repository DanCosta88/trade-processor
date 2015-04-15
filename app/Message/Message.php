<?php
namespace App\Message;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

	/**
	 * The database table used by the Message model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

    /**
     * @var array
     */
    protected $guarded = array();

    /**
     * Relationship: User
     *
     */
    public function user()
    {
        return $this->belongsTo('User');
    }


}
