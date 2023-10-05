<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('contacts', ['contacts' => Contact::all()->sortBy("name")]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('forms.contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Collection
     */
    public function store(ContactsRequest $request)
    {
        return Contact::create($this->validateRequest($request));
    }

    /**
     * Display the specified resource.
     *
     * @return View
     */
    public function show($slug)
    {
        return view('contact', ['contact' => Contact::where('slug', 'LIKE', $slug)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function edit($slug)
    {
        return view('forms.contact-edit', ['contact' => Contact::where('slug', 'LIKE', $slug)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Contact $contact
     * @param ContactsRequest $request
     * @return RedirectResponse
     */
    public function update(Contact $contact, ContactsRequest $request): RedirectResponse
    {
        $contact->update($this->validateRequest($request));
        return redirect($contact->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contact $contact
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect('dashboard/contacts');
    }

    /**
     * @param ContactsRequest $request
     * @return array
     */
    public function validateRequest(ContactsRequest $request): array
    {
        $validated = $request->validated();
        // add slug...
        $validated['slug'] = Str::slug($validated['name']);
        return $validated;
    }
}
