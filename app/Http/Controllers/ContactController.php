<?php

namespace App\Http\Controllers;

use App\Jobs\TestBirthdayEmail;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Contacts/Index', [
            'contacts' => Contact::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'relation' => 'required|string|max:255',
        ]);

        $request->user()->contacts()->create($request->all());

        return redirect(route('contacts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        Gate::authorize('update', $contact);
        return Inertia::render('Contacts/Edit', [
            'contact' => Contact::findOrFail($contact->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        Gate::authorize('update', $contact);

        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'relation' => 'required|string|max:255',
        ]);

        $contact->update($request->all());

        return redirect(route('contacts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        Gate::authorize('delete', $contact);
        $contact->delete();
        return redirect(route('contacts.index'));
    }

    /**
     * Send birthday email to the contact.
     */
    public function sendBirthdayNotification(Request $request)
    {
        $contact = Contact::findOrFail($request->id);
        $user = User::findOrFail(auth()->user()->id);
        TestBirthdayEmail::dispatch($user, $contact);
        return back();
    }
}
