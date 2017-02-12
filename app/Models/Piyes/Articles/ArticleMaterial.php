<?php

namespace App\Models\Piyes\Articles;

use App\Models\Piyes\BaseModel;

class ArticleMaterial extends BaseModel
{
    protected $table = 'article_materials';
    protected $fillable = ['article_id', 'title', 'main_file', 'publish', 'position', 'created_by', 'updated_by'];
    public static $rules = array(
        'article_id' => 'required',
    );
    public static $updaterules = array(
        'article_id' => 'required',
    );

    public static $fields = array('article_id', 'title');
    public static $imageFields = array(
    );
    public static $imageFieldNames = array(
        'main_file'
    );
    public static $docFields = array(
        'main_file'
    );
    public static $dateFields = array(
    );


    /**
     * An article image belongs to an article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

}