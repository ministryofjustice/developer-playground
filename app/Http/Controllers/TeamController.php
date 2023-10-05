<?php

namespace App\Http\Controllers;

use App\Models\CostCentre;
use App\Models\Organisation;
use App\Models\Team;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $teams = Team::orderBy('organisation_id')->orderBy("name")->get();
        return view('teams', ['teams' => $teams]);
    }

    public function create()
    {
        return view('forms.team', [
            'organisations' => Organisation::all()->sortBy("name"),
            'cost_centres' => CostCentre::all()->sortBy('name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function store()
    {
        Team::create($this->validateRequest());
        return redirect('/dashboard/teams');
    }

    public function show($slug)
    {
        return view('team', [
            'team' => Team::where('slug', 'LIKE', $slug)->first()
        ]);
    }

    public function edit($slug)
    {
        return view('forms.team-edit', [ 'team' => Team::where('slug', 'LIKE', $slug)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Team $team
     */
    public function update(Team $team)
    {
        $team->update($this->validateRequest($team->organisation_id));
        return redirect($team->path());
    }

    /**
     * @param null $org_id
     * @return array
     */
    protected function validateRequest($org_id = null): array
    {
        if ($org_id) {
            request('organisation_id', $org_id);
        }

        $request = request()->validate(Team::$createRules);
        // add slug...
        $request['slug'] = Str::slug($request['name']);
        return $request;
    }
}
