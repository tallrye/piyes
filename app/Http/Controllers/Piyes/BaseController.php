<?php

namespace App\Http\Controllers\Piyes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Piyes\SearchIndex;
use Image;
use File;

class BaseController extends Controller
{
    /**
     *
     * Turkish spesific letters
     * @var array
     */
    public static $turkish = array("ı", "ğ", "ü", "ş", "ö", "ç", "İ", "Ğ", "Ü", "Ş", "Ö", "Ç");

    /**
     *
     * English equivalents of letters in $turkish array
     * @var array
     */
    public static $english = array("i", "g", "u", "s", "o", "c", "i", "g", "u", "s", "o", "c");

    /**
     *
     * Turn given string into a readable URL
     * @param string $string 
     * @return string
     */
    public static function seo_friendly_url($string){
        $turkish = array("ı", "ğ", "ü", "ş", "ö", "ç", "İ", "Ğ", "Ü", "Ş", "Ö", "Ç");
        $english   = array("i", "g", "u", "s", "o", "c", "i", "g", "u", "s", "o", "c");
        $string = str_replace($turkish, $english, $string);
        $string = str_replace(array('[\', \']'), '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
        $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
        return strtolower(trim($string, '-'));
    }

    /**
     *
     * Turn given string into a readable URL
     * @param Illuminate\Support\Collection $record 
     * @param file $input 
     * @param string $column 
     * @return mixed
     */
    public function handleDateInput($record, $input, $column){
        if($input == null){
            return;
        }
        $day = substr($input, 0,2);
        $month = substr($input, 3,2);
        $year = substr($input, 6,4);
        $time = strtotime($month . '/'.$day.'/'.$year);
        $record->$column = date('Y-m-d', $time);
    }

    /**
     *
     * Attach image to a record after crop and save filename to DB
     * @param Illuminate\Support\Collection $record 
     * @param file $imageFile 
     * @param string $folder 
     * @param string $column 
     * @param string $width 
     * @param string $height 
     * @param string $w 
     * @param string $h 
     * @param string $x 
     * @param string $y 
     * @return mixed
     */
    public function handleImageCropUpload($record,$imageFile,$folder,$column,$width,$height,$w,$h,$x,$y){
        if(!$imageFile){
            return;
        }
        if($record->$column){
            File::delete(public_path('storage/'.$record->$column));
        }
        $filename = $column.time();
        $image = Image::make($imageFile);
        if(isNotImage($image->mime())){
            session()->flash('danger', 'You can only upload .png or .jpg files');
            return redirect()->back();
        }
        $image->crop($w, $h, $x, $y)->resize($width,$height)->save(public_path('storage/'.$folder.'_'.$filename.getImageExtension($image->mime())));
        $record->$column = $folder.'_'.$filename.getImageExtension($image->mime());
    }

    /**
     *
     * Attach image to a record and save filename to DB
     * @param Illuminate\Support\Collection $record 
     * @param file $imageFile 
     * @param string $width 
     * @param string $height 
     * @param string $folder 
     * @param string $column 
     * @return mixed
     */
    public function handleImageUpload($record,$imageFile,$width,$height,$folder,$column){
        if(!$imageFile){
            return;
        }
        if($record->$column){
            File::delete(public_path('storage/'.$record->$column));
        }
        $filename = $column.time();
        $image = Image::make($imageFile);
        if(isNotImage($image->mime())){
            session()->flash('danger', 'You can only upload .png or .jpg files');
            return redirect()->back();
        }
        $image->resize($width,$height)->save(public_path('storage/'.$folder.'_'.$filename.getImageExtension($image->mime())));
        $record->$column = $folder.'_'.$filename.getImageExtension($image->mime());
    }

    /**
     *
     * Attach file to a record and save filename to DB
     * @param Illuminate\Support\Collection $record 
     * @param file $docFile 
     * @param string $folder 
     * @param string $column 
     * @return mixed
     */
    public function handleFileUpload($record,$docFile,$folder,$column){
        if(!$docFile){
            return;
        }
        if($record->$column){
            File::delete(public_path('storage/'.$record->$column));
        }
        $file = $docFile;
        $extension = $file->getClientOriginalExtension();
        $filename = $folder.'_'.time() . '_' . $docFile->getClientOriginalName();
        $filename = str_replace(self::$turkish, self::$english, $filename);
        $file->move(public_path('storage/'), $filename);
        $record->$column = $filename;

    }
    
    /**
     *
     * Upload an image to gallery
     * @param array $rules 
     * @param Illuminate\Database\Eloquent\Model $model 
     * @param integer $foreign 
     * @return boolean
     */
    public function handleGalleryImage($rules, $model, $foreign){
        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()){
            $recordimage = new $model;
            $recordimage->{$foreign} = Input::get($foreign);
            $image = Input::file('image_path');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('storage/'.'/gallery/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $recordimage->image_path = 'storage/gallery/'.$filename;
            $recordimage->save();

            return true;
        }
    
        return false;
    }

    /**
     *
     * Delete a single gallery image
     * @param Illuminate\Database\Eloquent\Model $model 
     * @param integer $id 
     * @return mixed
     */
    public function handleGalleryImageDestroy($record, $model){
        if($record){
            if(count($model::$imageFieldNames)){
                foreach($model::$imageFieldNames as $imageField){
                    File::delete(public_path('storage/'.$record->$imageField));
                }
            }
            $record->delete();
            return true;
        }

        return false;
    }

    /**
     *
     * Delete a single gallery image
     * @param Illuminate\Database\Eloquent\Model $model 
     * @param integer $id 
     * @return mixed
     */
    public function handleFileDestroy($record, $model){
        if($record){
            if(count($model::$imageFieldNames)){
                foreach($model::$imageFieldNames as $imageField){
                    File::delete(public_path('storage/'.$record->$imageField));
                }
            }
            $record->delete();
            return true;
        }

        return false;
    }


    /**
     *
     * Sort items
     * @param Illuminate\Database\Eloquent\Model $model 
     * @param file $docFile 
     * @param string $folder 
     * @param string $column 
     * @return string
     */
    public function handleSort($model){
        $dataIds = json_decode(stripslashes($_POST['ids']));

        for($i=0; $i<count($dataIds); $i++){
            $record = $model->find($dataIds[$i]);
            $record->position = $i + 1;
            $record->save();
        }
        return 'Items sorted';
    }

    /**
     *
     * Delete a record along with the attached files and images.
     * @param Illuminate\Database\Eloquent\Model $model 
     * @param Illuminate\Support\Collection $record 
     * @param boolean $gallery 
     * @return boolean
     */
    public function handleDestroy($model, $record, $urlColumn, $gallery = true, $materials = false){
        if($gallery){
            if($record->images){
                foreach($record->images as $image) {
                    File::delete(public_path('storage/'.$image->main_image));
                    $image->delete();
                }
            }
        }
        if($materials){
            if($record->materials){
                foreach($record->materials as $material) {
                    File::delete(public_path('storage/'.$material->main_file));
                    $material->delete();
                }
            }
        }
        if($record){
            if(count($model::$imageFieldNames)){
                foreach($model::$imageFieldNames as $imageField){
                    File::delete(public_path('storage/'.$record->$imageField));
                }
            }
            if(count($model::$docFields)){
                foreach($model::$docFields as $docField){
                    File::delete(public_path('storage/'.$record->$docField));
                }
            }
            $record->delete();
            SearchIndex::where('keyword', $record->$urlColumn)->first()->delete();
            return true;
        }

        return false;
    }

}
