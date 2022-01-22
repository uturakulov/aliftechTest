<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $contacts = Contact::with('phoneMail')->where('name', 'like', '%' . $request->search . '%')->paginate(10);
        } else {
            $contacts = Contact::with('phoneMail')->paginate(10);
        }

        return view('contacts.contacts', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'store';

        return view('contacts.contactForm', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $validated = $request->validated();

        Contact::create($validated);

        return redirect()->route('contacts.index')->with('message', 'Successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'edit';

        $contact = Contact::findOrFail($id);

        return view('contacts.contactForm', compact('page', 'contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, $id)
    {
        $validated = $request->validated();

        $contact = Contact::findOrFail($id);
        $contact->name = $validated['name'];
        $contact->save();

        return redirect()->route('contacts.index')->with('message', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Contact::findOrFail($id)->delete();

        return redirect()->route('contacts.index')->with('message', 'Successfully deleted');
    }

    public function archived()
    {
        $contacts = Contact::onlyTrashed()->paginate(10);

        return view('contacts.contactsArchived', compact('contacts'));
    }

    public function restore($id)
    {
        Contact::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('contacts.archive')->with('message', 'Successfully restored');
    }

    public function destroy($id)
    {
        Contact::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('contacts.archive')->with('message', 'Successfully deleted');
    }
}
