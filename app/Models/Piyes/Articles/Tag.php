<?php

namespace App\Models\Piyes\Articles;

use App\Models\Piyes\BaseModel;

class Tag extends BaseModel
{
    protected $table = 'tags';
    protected $fillable = ['name', 'position', 'created_by', 'updated_by'];
    public static $rules = array(
        'name' => 'required|unique:tags',
    );
    public static $updaterules = array(
        'name' => 'required',
    );

    public static $fields = array('name');
    public static $imageFields = array(
    );
    public static $imageFieldNames = array(
    );
    public static $docFields = array(
    );
    public static $dateFields = array(
    );


    /**
     * A tag may belong to many articles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    /**
     *
     *
     Article list of a tag
     */
    public function getArticleListAttribute(){
        return $this->tags->pluck('id')->all();
    }
}