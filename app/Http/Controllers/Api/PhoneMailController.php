<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailsRequest;
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
        return PhoneMail::with('contacts')->paginate(10);
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

        return PhoneMail::paginate(10);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return PhoneMail::with('phoneMail')->findOrFail($id);
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

        return PhoneMail::paginate(10);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PhoneMail::findOrFail($id)->delete();

        return PhoneMail::paginate(10);
    }
}
