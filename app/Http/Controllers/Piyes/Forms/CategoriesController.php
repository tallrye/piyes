<?php

namespace App\Http\Controllers\Piyes\Forms;

use Illuminate\Http\Request;
use App\Http\Controllers\Piyes\BaseController;
use App\Models\Piyes\Inbox\ContactForm;
use App\Models\Piyes\Inbox\FormCategory;
use App\Models\Piyes\Inbox\FormRecipient;

class CategoriesController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, ContactForm $form)
    {
        checkPermissionFor('manage_forms');
        return view('piyes.forms.categories.create', compact('form'));
    }

    /**
     * Store new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        checkPermissionFor('manage_forms');
        $this->validate($request, FormCategory::$rules);
        FormCategory::create($request->all());
        session()->flash('success', 'New category has been created.');
        return redirect()->route('piyes.forms.edit', ['form' => $request->contact_form_id]);
    }

    /**
     * Edit existing record.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(FormCategory $category)
    {
        checkPermissionFor('manage_forms');
        return view('piyes.forms.categories.edit', compact('category'));
    }

    /**
     * Edit existing record.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormCategory $category)
    {
        checkPermissionFor('manage_forms');
        $this->validate($request, FormCategory::$rules);
        $category->update($request->all());
        session()->flash('success', 'Form has been updated.');
        return redirect()->back();
    }

    /**
     * Delete existing record
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(FormCategory $category)
    {
        $form = $category->form;
        checkPermissionFor('manage_forms');
        $category->delete();
        session()->flash('success', 'Form category has been deleted');
        return redirect()->route('piyes.forms.edit', $form->id);
    }
}