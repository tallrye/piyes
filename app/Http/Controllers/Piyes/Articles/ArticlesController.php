<?php

namespace App\Http\Controllers\Piyes\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Piyes\BaseController;
use App\Models\Piyes\Articles\Article as PageModel;
use App\Models\Piyes\Articles\Tag;
use App\Models\Piyes\SearchIndex;
use View;
use File;

class ArticlesController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PageModel $model)
    {
        $this->middleware('auth');
        $this->pageUrl = 'articles';
        $this->pageName = 'Articles';
        $this->pageItem = 'Article';
        $this->urlColumn = 'title';
        $this->hasUrl = true;
        $this->hasPublish = true;
        $this->model = $model;
        $this->fields = $model::$fields;
        $this->imageFields = $model::$imageFields;
        $this->docFields = $model::$docFields;
        $this->dateFields = $model::$dateFields;
        View::share(array(
            'pageUrl' => $this->pageUrl,
            'pageName' => $this->pageName,
            'pageItem' => $this->pageItem,
        ));
    }

    /**
     * Show the listing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        checkPermissionFor('manage_'.$this->pageUrl);
        $records = PageModel::all();
        return view('piyes.'.$this->pageUrl.'.index', compact('records'));
    }

    /**
     * Show the form for creating new record.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        checkPermissionFor('manage_'.$this->pageUrl);
        $tags = Tag::pluck('name','id')->all();
        return view('piyes.'.$this->pageUrl.'.create', compact('tags'));
    }

    /**
     * Show the re-ordering page.
     *
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request)
    {
        checkPermissionFor('manage_'.$this->pageUrl);
        $records = PageModel::all();
        return view('piyes.'.$this->pageUrl.'.sort', compact('records'));
    }

    /**
     * Reorder records
     *
     * @return \Illuminate\Http\Response
     */
    public function sortRecords(Request $request){
        parent::handleSort($this->model);
    }

    /**
     * Store new record.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        checkPermissionFor('manage_'.$this->pageUrl);
        $this->validate($request, PageModel::$rules);
        $record = new PageModel;
        if($this->hasPublish){
            (($request->publish) ? $record->publish = true : $record->publish = false);
        }
        if($this->hasUrl){
            $record->url = parent::seo_friendly_url($request->{$this->urlColumn});
        }
        /** Regular Inputs **/
        foreach($this->fields as $field){
            $record->$field = $request->get($field);
        }
        /** Date Inputs **/
        if($this->dateFields){
            foreach($this->dateFields as $dateField){
                parent::handleDateInput($record, $request->get($dateField), $dateField);
            }
        }

        /** File Inputs **/
        foreach($this->docFields as $docField){
            parent::handleFileUpload($record, $request->file($docField), $this->pageUrl, $docField);
        }

        /** Image Inputs **/
        if($this->imageFields){
            foreach($this->imageFields as $imageField){
                if(array_key_exists('crop', $imageField)){
                    parent::handleImageCropUpload(
                        $record, 
                        $request->get($imageField['name']), 
                        $this->pageUrl, 
                        $imageField['name'], 
                        $imageField['width'], 
                        $imageField['height'], 
                        round($request->get('w')), round($request->get('h')), round($request->get('x')), round($request->get('y'))
                    );
                }else{
                     parent::handleImageUpload(
                        $record, 
                        $request->get($imageField['name']), 
                        $imageField['width'], 
                        $imageField['height'], 
                        $this->pageUrl, 
                        $imageField['name']);
                }
            }
        }

        $record->save();
        $record->tags()->sync($request->tag_list ?: []);
        SearchIndex::create([
            "keyword" => $record->{$this->urlColumn},
            "folder" => $this->pageUrl,
            "key" => $record->id
        ]);

        session()->flash('success', 'New '.$this->pageItem.' has been created.');
        return redirect()->route('piyes.'.$this->pageUrl.'.edit', ['record' => $record->id]);
    }

    /**
     * Edit existing record.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(PageModel $record)
    {
        checkPermissionFor('manage_'.$this->pageUrl);
        $tags = Tag::pluck('name','id')->all();
        return view('piyes.'.$this->pageUrl.'.edit', compact('record', 'tags'));
    }

    /**
     * Edit existing record.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PageModel $record)
    {
        checkPermissionFor('manage_'.$this->pageUrl);
        $this->validate($request, PageModel::$updaterules);
        SearchIndex::where('keyword', $record->{$this->urlColumn})->first()->delete();
        $record->tags()->sync($request->tag_list ?: []);
        if($this->hasPublish){
            (($request->publish) ? $record->publish = true : $record->publish = false);
        }
        if($this->hasUrl){
            $record->url = parent::seo_friendly_url($request->{$this->urlColumn});
        }
        /** Regular Inputs **/
        foreach($this->fields as $field){
            $record->$field = $request->get($field);
        }
        /** Date Inputs **/
        if($this->dateFields){
            foreach($this->dateFields as $dateField){
                parent::handleDateInput($record, $request->get($dateField), $dateField);
            }
        }
        /** File Inputs **/
        foreach($this->docFields as $docField){
            parent::handleFileUpload($record, $request->file($docField), $this->pageUrl, $docField);
        }

        /** Image Inputs **/
        if($this->imageFields){
            foreach($this->imageFields as $imageField){
                if(array_key_exists('crop', $imageField)){
                    parent::handleImageCropUpload(
                        $record, 
                        $request->get($imageField['name']), 
                        $this->pageUrl, 
                        $imageField['name'], 
                        $imageField['width'], 
                        $imageField['height'], 
                        round($request->get('w')), round($request->get('h')), round($request->get('x')), round($request->get('y'))
                    );
                }else{
                     parent::handleImageUpload(
                        $record, 
                        $request->get($imageField['name']), 
                        $imageField['width'], 
                        $imageField['height'], 
                        $this->pageUrl, 
                        $imageField['name']);
                }
            }
        }
        $record->save();
        SearchIndex::create([
            "keyword" => $record->{$this->urlColumn},
            "folder" => $this->pageUrl,
            "key" => $record->id
        ]);
        session()->flash('success', $this->pageItem.' has been updated.');
        return redirect()->back();
    }

    /**
     * Delete existing record
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(PageModel $record)
    {
        checkPermissionFor('manage_'.$this->pageUrl);
        if(parent::handleDestroy($this->model, $record, $this->urlColumn, true, true)){
            session()->flash('success', $this->pageItem.' has been deleted');
        }else{
            session()->flash('danger', 'No such record.');
        }
        return redirect()->route('piyes.'.$this->pageUrl.'.index');
        
    }

    /**
     * Delete existing record's single file
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteFile(PageModel $record)
    {
        checkPermissionFor('manage_'.$this->pageUrl);
        File::delete(public_path('storage/'.$record->main_file));
        $record->main_file = "";
        $record->save();
        session()->flash('success', 'File deleted.');
        return redirect()->back();
        
    }
}