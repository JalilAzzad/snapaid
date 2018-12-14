<?php

namespace App\Http\Controllers\Auth;

use App\Cause;
use App\CausesCategory;
use App\Country;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/causes';


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
     //   $countries = Country::all();
        $causes = $request->session()->get('causes', null);
        if(is_null($causes))
            return redirect('join/causes');

        $causes = explode(',', $causes);

        return view('auth.register'/*, ['countries' => $countries]*/);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $causes = $request->session()->get('causes', null);
        if(is_null($causes))
            return redirect('join/causes');

        $causes = explode(',', $causes);

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $user->causes()->sync($causes);

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


    protected function registered(Request $request, $user)
    {
        $shouldSend = true;
        if (!is_null($user->email_code_send_at)) {
            if ($user->email_code_send_at->addMinutes(5)->isFuture()) {
                $shouldSend = false;
            } else {
                $user->email_code_send_at = Carbon::now();
            }
        } else {
            $user->email_code_send_at = Carbon::now();
        }
        $user->save();

        if ($shouldSend) {
            Mail::send('emails.confirm', ['user' => $user, 'email_confirm_code' => $user->email_code], function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject('Your confirmation email!');
            });
        }

        return view('auth.emailconfirm');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['confirmEmail', 'confirmEmailError']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|min:10|max:15',
            'birthdate' => 'required|date',
            'password' => 'required|string|min:6|confirmed',
//            'address1' => 'required|string|min:10|max:255',
//            'address2' => 'max:255',
//            'city' => 'required|string|min:3|max:255',
//            'state' => 'required|string|min:2|max:255',
//            'zip' => 'required|string|min:4|max:10',
//            'country' => 'required|integer|exists:countries,id'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_code' => str_random(),
            'email_code_send_at' => Carbon::now()->toDateTimeString(),
            'phone' => $data['phone'],
//            'address1' => $data['address1'],
//            'address2' => $data['address2'],
//            'city' => $data['city'],
//            'state' => $data['state'],
//            'zip' => $data['zip'],
//            'country' => $data['country'],
            'birth_date' => $data['birthdate']
        ]);
    }

    public function confirmEmailError()
    {
        $user = User::find((int) \auth()->id());
        if(! (bool) $user->is_confirmed)
        {
            return view('auth.emailconfirmerror');
        } else {
            abort(404);
        }
    }

    public function confirmEmail($id, $email_confirm_code)
    {
        $user = User::find((int) $id);
        if($user->email_code === $email_confirm_code)
        {
            $user->is_confirmed = true;
            $user->save();

            auth()->login($user);

            return view('auth.success');
        } else {
            return view('auth.fail');
        }
    }

    public function showRegisterCausesForm(Request $request)
    {
        $categories = CausesCategory::with('causes')->get();

        $featured_causes = Cause::leftJoin('reports', 'causes.id', '=', 'reports.cause_id')
            ->selectRaw('causes.*, sum(reports.status) as count')
            ->whereBetween('reports.created_at', [Carbon::now()->subDays(7)->toDateTimeString(), Carbon::now()->toDateTimeString()])
            ->groupBy('causes.id')
            ->orderBy('count', 'desc')
            ->take(8)
            ->get();

        return view('auth.causes', ['categories' => $categories, 'featured_causes' => $featured_causes]);
    }

    public function registerCauses(Request $request)
    {
        $featured_causes = Cause::leftJoin('reports', 'causes.id', '=', 'reports.cause_id')
            ->selectRaw('causes.*, sum(reports.status) as count')
            ->whereBetween('reports.created_at', [Carbon::now()->subDays(7)->toDateTimeString(), Carbon::now()->toDateTimeString()])
            ->groupBy('causes.id')
            ->orderBy('count', 'desc')
            ->take(8)
            ->get();

        $validator = Validator::make($request->all(), [
            'causes' => 'required|array'
        ]);

        if ($validator->fails()) {
            return redirect('/join/causes')
                ->withErrors($validator)
                ->withInput();
        }

        $cause = "";
        foreach ($request->input('causes') as $key => $c)
        {
            $cause .= $key == 0 ? $c : ",".$c;
            $validator = Validator::make(['cause' => $c], [
                'cause' => 'exists:causes,id'
            ]);

            if ($validator->fails()) {
                return redirect('/join/causes')
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        foreach ($request->all() as $key => $ca)
        {
            if( $key != "causes" || $key != "submit" )
            {
                foreach ($featured_causes as $featured_cause)
                {
                    if($key == url('/images/causes/'.$featured_cause->id.'.'.$featured_cause->file_ext))
                    {
                        $cause .= $key == 0 ? $featured_cause->id: ",".$featured_cause->id;
                    }
                }
            }
        }

        session(['causes' => $cause]);

        return redirect('join/accountinfo');
    }

}
