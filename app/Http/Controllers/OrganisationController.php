<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrganisationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        return view('forms.organisation');
    }

    public function index()
    {
        return view('organisations', ['organisations' => Organisation::orderBy('name')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function store()
    {
        Organisation::create($this->validateRequest());
        return redirect('/dashboard/organisations');
    }

    public function update(Organisation $org)
    {
        $data = request()->validate([
            'name' => 'required|max:120',
            'address' => 'required',
            'description' => ''
        ]);

        $data['slug'] = Str::slug($data['name']);

        $org->update($data);

        return redirect($org->path());
    }

    public function show($slug)
    {
        return view('organisation', [
            'organisation' => Organisation::where('slug', 'LIKE', $slug)->first()
        ]);
    }

    public function edit($slug)
    {
        return view(
            'forms.organisation-edit',
            [
                'organisation' => Organisation::where('slug', 'LIKE', $slug)->first()
            ]
        );
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        $request = request()->validate(Organisation::$createRules);
        // add slug...
        $request['slug'] = Str::slug($request['name']);
        return $request;
    }
}
