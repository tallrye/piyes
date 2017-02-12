<?php

namespace App\Models\Piyes\Articles;

use App\Models\Piyes\BaseModel;

class ArticleImage extends BaseModel
{
    protected $table = 'article_images';
    protected $fillable = ['article_id', 'title', 'main_image', 'publish', 'position', 'created_by', 'updated_by'];
    public static $rules = array(
        'article_id' => 'required',
    );
    public static $updaterules = array(
        'article_id' => 'required',
    );

    public static $fields = array('article_id', 'title');
    public static $imageFields = array(
        ["name" => "main_image", "width" => 700, "height" => 500, 'crop' => true]
    );
    public static $imageFieldNames = array(
        "main_image"
    );
    public static $docFields = array(
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