<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsRequest;
use App\Models\BusinessCase;
use App\Models\Contact;
use App\Models\Licence;
use App\Models\Tool;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ToolController extends Controller
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
        return view('tools', ['tools' => Tool::orderBy('approved', 'desc')->orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('forms.tooling', [
            'tooling' => request()->session()->get('tooling-data') ?? []
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function createContact(): View
    {
        return view('forms.tooling-contact', [
            'tooling' => request()->session()->get('tooling-data') ?? []
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function createBusinessCase(): View
    {
        return view('forms.tooling-business-case', [
            'tooling' => request()->session()->get('tooling') ?? []
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function createSummary(): View
    {
        return view('forms.tooling-summary', [
            'tooling' => request()->session()->get('tooling') ?? [],
            'contact' => request()->session()->get('contact') ?? [],
            'business-case' => request()->session()->get('business-case') ?? [],
        ]);
    }

    public function storeSessionData(Request $request)
    {
        // associate user with the tool
        $data = array_merge($this->validateRequest(), [
            'slug' => Str::slug(request()->name)
        ]);

        $request->session()->put('tooling', $data);

        return redirect('/dashboard/tools/create/contact');
    }

    /**
     * @param ContactsRequest $request
     * @return RedirectResponse
     */
    public function storeContact(ContactsRequest $request)
    {
        if ($request->get('skip_contact') === 'yes') {
            $request->session()->forget('contact');
            return redirect(route('tools-create-business-case'));
        }

        $contact = $request->validated();
        $contact['slug'] = Str::slug($contact['name']);

        $request->session()->put('contact', $contact);

        return redirect(route('tools-create-business-case'));
    }

    public function storeBusinessCase(Request $request)
    {
        if ($request->get('business-case') === 'no') {
            $request->session()->forget('business-case');
            return redirect(route('tools-view-summary'));
        }

        $business_case = $request->validate(BusinessCase::$createRules);
        $business_case['slug'] = Str::slug($business_case['name']);

        $request->session()->put('business-case', $business_case);

        return redirect(route('tools-view-summary'));
    }

    public function viewSummary()
    {
        return view('forms.tooling-summary', [
            'tooling' => request()->session()->get('tooling'),
            'contact' => request()->session()->get('contact'),
            'business_case' => request()->session()->get('business-case')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function store()
    {
        // create a contact or get the current auth user and evaluate as a tooling contact
        if ($contact = request()->session()->get('contact')) {
            $user = Contact::create($contact);
        } else {
            // no contact specified, use the logged-in user
            $contact = Auth::user();
            $user = Contact::where('email', 'LIKE', $contact->email)->first();
            // check: already marked as a contact?
            if (empty($user)) {
                $user = Contact::create([
                    'name' => $contact->name,
                    'slug' => Str::slug($contact->name),
                    'email' => $contact->email
                ]);
            }
        }

        // create the tool
        $tool = Tool::create(array_merge(request()->session()->get('tooling'), ['contact_id' => $user->id]));
        // fire the event
        $tool->action(
            'Tooling procurement for ' . $tool->name . ' was initiated by <small><a href="mailto:' . $user->email . '">' . $user->name . '</a></small>.',
            true
        );

        // create an empty licence
        $licence = Licence::create(['tool_id' => $tool->id]);
        // fire the event
        $tool->action('<strong class="govuk-tag govuk-tag--yellow">empty</strong> licence generated.
            <a href="' . route('licences-edit', $licence->id) . '">Add information here.</a>'
        );

        // create a business case, if requested
        if ($business_case = request()->session()->get('business-case')) {
            BusinessCase::create(
                array_merge($business_case, [
                    'tool_id' => $tool->id
                ])
            );
            $tool->action('Business case created');
        }

        // clear the session data
        request()->session()->forget('tooling');
        request()->session()->forget('contact');
        request()->session()->forget('business-case');

        return redirect('/dashboard/tools/' . $tool->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return View
     */
    public function show($slug): View
    {
        return view('tool', ['tool' => Tool::where(['slug' => $slug])->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tool $tool
     * @return Response
     */
    public function edit(Tool $tool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Tool $tool
     */
    public function update(Tool $tool)
    {
        $tool->action('Tool updated');
        $tool->update($this->validateRequest());
        return redirect($tool->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tool $tool
     */
    public function destroy(Tool $tool)
    {
        $tool->delete();
        return redirect('/dashboard/tools');
    }

    public function find($search)
    {
        $search = str_replace('-', ' ', $search);
        $tools = Tool::where('name', 'LIKE', '%' . $search . '%')->get();
        return ['results' => $tools];
    }

    public function approve(Tool $tool, Request $request)
    {
        $tool->approved = $request->approved;
        $tool->save();

        $user = Auth::user();
        $comms = '<small><a href="mailto:' . $user->email . '">' . $user->name . '</a></small>';
        if (isset($user->slack)) {
            $comms = '<a href="https://mojdt.slack.com/team/' . $user->slack . '" target="_blank">' . $user->name . '</a>';
        }

        $approved = 'un';
        $colour = 'red';

        if ($request->approved) {
            $approved = '';
            $colour = 'turquoise';
        }

        $reason = '<div class="govuk-inset-text">' . $request->approved_reason . '</div>';

        $message = '<strong class="govuk-tag govuk-tag--' . $colour . '">' . $approved . 'approved for purchase</strong>';
        $message = 'Tooling was ' . $message . ' by '
            . $comms . ' with the following message:' . $reason;

        $tool->action($message, true);
        return redirect($tool->path());
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate(Tool::$createRules);
    }
}
