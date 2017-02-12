<?php

namespace App\Http\Controllers\Piyes\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Piyes\BaseController;
use App\Models\Piyes\Articles\Article as ParentModel;
use App\Models\Piyes\Articles\ArticleMaterial as PageModel;
use View;
use File;

class MaterialsController extends BaseController
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
        $this->pageItem = 'Article Material';
        $this->urlColumn = 'title';
        $this->parentKey = 'article_id';
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
    public function index(Request $request, ParentModel $record)
    {
        checkPermissionFor('manage_'.$this->pageUrl);
        return view('piyes.'.$this->pageUrl.'.materials.index', compact('record'));
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
     * Show the listing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parent = ParentModel::findOrFail($request->{$this->parentKey});
        $record = new PageModel;
        if($this->hasPublish){
            (($request->publish) ? $record->publish = true : $record->publish = false);
        }
        /** Regular Inputs **/
        foreach($this->fields as $field){
            $record->$field = $request->get($field);
        }
        /** File Inputs **/
        foreach($this->docFields as $docField){
            parent::handleFileUpload($record, $request->file($docField), $this->pageUrl, $docField);
        }

        $record->save();
        session()->flash('success', 'New '.$this->pageItem.' has been created.');
        return redirect()->route('piyes.'.$this->pageUrl.'.materials', ['record' => $parent->id]);
    }

    /**
     * Edit existing record.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(PageModel $record)
    {
        return view('piyes.'.$this->pageUrl.'.materials.edit', compact('record'));
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
        if($this->hasPublish){
            (($request->publish) ? $record->publish = true : $record->publish = false);
        }
        
        /** Regular Inputs **/
        foreach($this->fields as $field){
            $record->$field = $request->get($field);
        }

        /** File Inputs **/
        foreach($this->docFields as $docField){
            parent::handleFileUpload($record, $request->file($docField), $this->pageUrl, $docField);
        }
        $record->save();
        
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
        $parent = ParentModel::findOrFail($record->{$this->parentKey});
        if(parent::handleFileDestroy($record, $this->model)){
            session()->flash('success', $this->pageItem.' has been deleted');
        }else{
            session()->flash('danger', 'No such record.');
        }
        return redirect()->route('piyes.'.$this->pageUrl.'.materials', ['record' => $parent->id]);
        
    }

}