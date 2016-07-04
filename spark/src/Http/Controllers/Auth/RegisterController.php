<?php

namespace Laravel\Spark\Http\Controllers\Auth;

use Laravel\Spark\Spark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Spark\Events\Auth\UserRegistered;
use Laravel\Spark\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Laravel\Spark\Contracts\Interactions\Auth\Register;
use Laravel\Spark\Contracts\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Admin\InvitedCustomerRequest;
use App\Mailers\AppMailer;
use App\User;

class RegisterController extends Controller
{
    use RedirectsUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showRegistrationForm(Request $request)
    {
        if (Spark::promotion() && ! $request->has('coupon')) {
            // If the application is running a site-wide promotion, we will redirect the user
            // to a register URL that contains the promotional coupon ID, which will force
            // all new registrations to use this coupon when creating the subscriptions.
            return redirect($request->fullUrlWithQuery([
                'coupon' => Spark::promotion()
            ]));
        }

        return view('spark::auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  RegisterRequest  $request
     * @return Response
     */
    public function register(RegisterRequest $request, AppMailer $mailer)
    {
        Auth::login($user = Spark::interact(
            Register::class, [$request]
        ));

        event(new UserRegistered($user));

	$mailer->sendEmailConfirmationTo($user);

        return response()->json([
            'redirect' => $this->redirectPath()
        ]);
    }

    /**
     * Handle a confirmation email for the application.
     *
     * @param  $token
     */
    public function confirmEmail($token, AppMailer $mailer) {
        $user = User::whereVerificationToken($token)->firstOrFail();
        User::whereVerificationToken($token)->firstOrFail()->confirmEmail();
        $mailer->sendEmailWelcomeTo($user);
        flash('You are now confirmed. Please login.');
        return redirect('login');
    }

    /**
     * Handle customer invitation.
     *
     * @param  $token
     */
    public function inviteCustomer($token) {
        $viewData = [];
        $viewData['token'] = $token;
        return view('spark::invitation', $viewData);
    }

    /**
     * Handle customer registration with invite.
     *
     * @param  InvitedCustomerRequest $request
     */
    public function postInviteCustomer(InvitedCustomerRequest $request, AppMailer $mailer) {
        $user = User::whereVerificationToken($request->verification_token)->firstOrFail();
        $user->verified = true;
        $user->verification_token = null;
        $user->password = \Hash::make($request->password);
//        $request->merge(['verification_token' => \Hash::make($request->password)]);
        $user->save();
        $mailer->sendEmailWelcomeTo($user);
        return redirect('/home');
    }
}
