<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailsRequest;
use App\Models\Contact;
use App\Models\PhoneMail;
use App\Services\DetailsService;
use Illuminate\Http\Request;

class PhoneMailController extends Controller
{
    private $detailService;

    public function __construct(DetailsService $detailservice)
    {
        $this->detailService = $detailservice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = PhoneMail::with('contacts')->paginate(10);

        return view('details.details', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'store';

        $contacts = Contact::all();

        return view('details.detailsForm', compact('page', 'contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DetailsRequest $request)
    {
        $validated = $request->validated();

        $this->detailService->storeDetail($validated);

        return redirect()->route('details.index')->with('message', 'Successfully added');
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
        $page = 'update';

        $contacts = Contact::all();

        $detail = PhoneMail::findOrFail($id);

        return view('details.detailsForm', compact('page', 'contacts', 'detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DetailsRequest $request, $id)
    {
        $validated = $request->validated();

        $this->detailService->updateDetail($validated, $id);

        return redirect()->route('details.index')->with('message', 'Successfully added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        PhoneMail::findOrFail($id)->delete();

        return redirect()->route('details.index')->with('message', 'Successfully deleted');
    }

    public function archived()
    {
        $details = PhoneMail::onlyTrashed()->paginate(10);

        return view('details.detailsArchived', compact('details'));
    }

    public function restore($id)
    {
        PhoneMail::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('details.archive')->with('message', 'Successfully restored');
    }

    public function destroy($id)
    {
        PhoneMail::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('details.archive')->with('message', 'Successfully deleted');
    }
}
