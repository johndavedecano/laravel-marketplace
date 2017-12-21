<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Unguarded fields
     *
     * @var array
     */
    public $fillable = [
        'user_id',
        'location_id',
        'title',
        'description',
        'price',
        'status',
        'is_expired',
        'is_featured',
        'is_hidden',
        'expires_at',
    ];

    /**
     * Get user relationship
     *
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get location relationship
     *
     * @return App\Location
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    /**
     * Get post comments collection
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get post images collection
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function images()
    {
        return $this->belongsToMany('App\Image', 'posts_images', 'post_id', 'image_id');
    }

    /**
     * Get post categories collection
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'posts_categories', 'post_id', 'category_id');
    }
}
