<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        setPageMeta('Contacts');

        $contacts = Contact::latest()->paginate();

        return view('contacts.index', compact('contacts'));
    }

    public function store(ContactRequest $request)
    {
        $data = $request->validated();

        Contact::create($data);

        return response()->json(['success' => true, 'message' => 'Message sent successfully.']);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        sendFlash('Contact deleted successfully');
        return back();
    }
}
