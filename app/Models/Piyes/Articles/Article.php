<?php

namespace App\Models\Piyes\Articles;

use App\Models\Piyes\BaseModel;

class Article extends BaseModel
{
    protected $table = 'articles';
    protected $fillable = ['title', 'caption', 'description', 'url', 'main_image', 'main_file', 'publish', 'position', 'publish_at', 'publish_until', 'created_by', 'updated_by'];
    public static $rules = array(
        'title' => 'required|unique:articles',
        'caption' => 'required',
        'description' => 'required',
    );
    public static $updaterules = array(
        'title' => 'required',
        'caption' => 'required',
        'description' => 'required',
    );

    public static $fields = array('title', 'caption', 'description');
    public static $imageFields = array(
        ["name" => "main_image", "width" => 700, "height" => 500, 'crop' => true]
    );
    public static $imageFieldNames = array(
        "main_image"
    );
    public static $docFields = array(
        "main_file"
    );
    public static $dateFields = array(
        'publish_at', 'publish_until',
    );

    public static function boot(){
        parent::boot();
        static::creating(function($model)
        {
            if($model->publish_at == null){
                $model->publish_at = todayWithFormat('Y-m-d');
            } 
        });
    }

    /**
     * An article may belong to many tags.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * An article may have many images.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function images()
    {
        return $this->hasMany(ArticleImage::class);
    }

    /**
     * An article may have many materials.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function materials()
    {
        return $this->hasMany(ArticleMaterial::class);
    }

    /**
     *
     * Tag list of an article
     *
     */
    public function getTagListAttribute(){
        return $this->tags->pluck('id')->all();
    }
}