<?php

namespace App\Http\Controllers;

use App\Models\CostCentre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CostCentreController extends Controller
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
    public function index(): View
    {
        return view('cost-centres', ['cost_centres' => CostCentre::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $cost_centre = CostCentre::create($this->validateRequest());
        return redirect(route('cost-centre', $cost_centre->slug));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('forms.cost-centre');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function edit($slug)
    {
        return view('forms.cost-centre-edit', ['cost_centre' => CostCentre::where('slug', 'LIKE', $slug)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CostCentre $cost_centre
     * @return RedirectResponse
     */
    public function update(CostCentre $cost_centre): RedirectResponse
    {
        $data = $this->validateRequest('edit');
        $cost_centre->update($data);
        $route = route('cost-centre', $data['slug']);
        return redirect($route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CostCentre $cost_centre
     * @return RedirectResponse
     */
    public function destroy(CostCentre $cost_centre)
    {
        $cost_centre->delete();
        return redirect(route('cost-centres'));
    }

    /**
     * Display the specified resource.
     *
     * @return View
     */
    public function show($slug)
    {
        return view('cost-centre', ['cost_centre' => CostCentre::where('slug', 'LIKE', $slug)->first()]);
    }

    /**
     * @return array
     */
    public function validateRequest($action = 'create'): array
    {
        $request = request()->validate(($action === 'create'
            ? CostCentre::$createRules
            : CostCentre::$editRules
        ));

        // add slug...
        $request['slug'] = Str::slug($request['name']);
        return $request;
    }
}
