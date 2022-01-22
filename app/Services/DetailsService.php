<?php

namespace App\Services;

use App\Models\PhoneMail;

class DetailsService
{
    public function storeDetail($validated)
    {
        $details = new PhoneMail();
        $details->phone = $validated['phone'];
        $details->email = $validated['email'];
        $details->contact_id = $validated['contact_id'];
        $details->save();
    }

    public function updateDetail($validated, $id)
    {
        $details = PhoneMail::findOrFail($id);
        $details->phone = $validated['phone'];
        $details->email = $validated['email'];
        $details->contact_id = $validated['contact_id'];
        $details->save();
    }
}
