<?php

namespace App\Http\Controllers\Piyes\Forms;

use Illuminate\Http\Request;
use App\Http\Controllers\Piyes\BaseController;
use App\Models\Piyes\Inbox\ContactForm;
use App\Models\Piyes\Inbox\FormCategory;
use App\Models\Piyes\Inbox\FormRecipient;

class FormsController extends BaseController
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
     * Show the listing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        checkPermissionFor('manage_forms');
        $forms = ContactForm::all();
        return view('piyes.forms.index', compact('forms'));
    }

    /**
     * Show the form for creating new record.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        checkPermissionFor('manage_forms');
        return view('piyes.forms.create');
    }

    /**
     * Store new record.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        checkPermissionFor('manage_forms');
        $this->validate($request, ContactForm::$rules);
        ContactForm::create($request->all());
        session()->flash('success', 'New form has been created.');
        return redirect()->route('piyes.forms.index');
    }

    /**
     * Edit existing record.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactForm $form)
    {
        checkPermissionFor('manage_forms');
        return view('piyes.forms.edit', compact('form'));
    }

    /**
     * Edit existing record.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactForm $form)
    {
        checkPermissionFor('manage_forms');
        $this->validate($request, ContactForm::$updaterules);
        $form->update($request->all());
        session()->flash('success', 'Form has been updated.');
        return redirect()->back();
    }

    /**
     * Delete existing record
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(ContactForm $form)
    {
        checkPermissionFor('manage_forms');
        foreach($form->categories as $category){
            $category->delete();
        }
        $form->delete();
        session()->flash('success', 'Form has been deleted');
        return redirect()->route('piyes.forms.index');
    }
}