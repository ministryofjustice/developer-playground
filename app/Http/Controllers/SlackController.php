<?php

namespace App\Http\Controllers;

use App\Models\Slack;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SlackController extends Controller
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
        return view('slack-settings', ['settings' => Slack::all()->sortBy("name")]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('forms.slack');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $slack = Slack::create($this->validateRequest());
        return redirect(route('slack-setting', $slack->slug));
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return View
     */
    public function show($slug)
    {
        return view('slack-setting', ['setting' => Slack::where('slug', 'LIKE', $slug)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $slug
     * @return View
     */
    public function edit($slug)
    {
        return view('forms.slack-edit', ['settings' => Slack::where('slug', 'LIKE', $slug)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Slack $slack
     * @return RedirectResponse
     */
    public function update(Slack $slack)
    {
        $slack->update($this->validateRequest(false));
        return redirect($slack->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slack $slack
     * @return RedirectResponse
     */
    public function destroy(Slack $slack)
    {
        $slack->delete();
        return redirect(route('slack-settings'));
    }

    /**
     * @param bool $validate
     * @return array
     */
    public function validateRequest(bool $is_create = true): array
    {
        if ($is_create) {
            $request = request()->validate(Slack::$createRules);
        } else {
            $request = request()->validate(Slack::$editRules);
        }

        // add slug...
        $request['slug'] = Str::slug($request['name']);
        return $request;
    }
}
