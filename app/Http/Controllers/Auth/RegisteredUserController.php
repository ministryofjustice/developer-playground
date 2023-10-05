<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\Team;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use View;

class RegisteredUserController extends Controller
{
    /**
     * Display the org/team select view.
     *
     * @return \Illuminate\View\View
     */
    public function selectOrgTeam(): \Illuminate\View\View
    {
        return view('auth.create-an-account', [
            'organisations' => Organisation::with('teams')->get()
        ]);
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeOrgTeam(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'organisation' => 'required|numeric',
            'team' => 'required|numeric'
        ]);

        $request->session()->put('org-team', $data);

        return redirect('/create-an-account/register');
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View|RedirectResponse
     */
    public function create(Request $request)
    {
        $org_team = $request->session()->get('org-team');

        if (!$org_team) {
            return redirect('/create-an-account');
        }

        $data = [
            'organisation' => Organisation::find($org_team['organisation'])->name,
            'team' => Team::find($org_team['team'])->name
        ];

        return view('auth.create-an-account-register', ['data' => $data]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'ends_with:justice.gov.uk'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'team_id' => $request->session()->get('org-team')['team']
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function createTeamAddition()
    {
        return view('forms.team-addition', ['organisations' => Organisation::all()]);
    }

    public function requestTeamAddition(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'team' => 'required|string',
            'organisation' => 'required|numeric'
        ]);

        /**
         * TODO: integrate the Notification channel for Slack
         * Composer already requires the channel, setup is needed;
         * https://laravel.com/docs/8.x/notifications#slack-prerequisites
         */

        return redirect('your-team-addition-request-has-been-sent');
    }

    public function thankYouForYourRequest()
    {
        return view('thanks.team-request-sent');
    }
}
