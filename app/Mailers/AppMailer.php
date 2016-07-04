<?php

namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;

class AppMailer {

    /**
     * The Laravel Mailer instance.
     *
     * @var Mailer
     */
    protected $mailer;

    /**
     * The sender of the email.
     *
     * @var string
     */
    protected $from = 'support@depotdash.com';

    /**
     * The recipient of the email.
     *
     * @var string
     */
    protected $to;

    /**
     * The subject for the email.
     *
     * @var string
     */
    protected $subject;

    /**
     * The view for the email.
     *
     * @var string
     */
    protected $view;

    /**
     * The data associated with the view for the email.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Create a new app mailer instance.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer) {
        $this->mailer = $mailer;
    }

    /**
     * Deliver the email confirmation.
     *
     * @param  User $user
     * @return void
     */
    public function sendEmailConfirmationTo(User $user) {
        $this->to = $user->email;
        $this->view = 'emails.confirm';
        $this->subject = 'Confirmation';
        $this->data = compact('user');

        $this->deliver();
    }

    /**
     * Deliver the welcome email.
     *
     * @param  User $user
     * @return void
     */
    public function sendEmailWelcomeTo(User $user) {
        $this->to = $user->email;
        $this->view = 'emails.welcome';
        $this->subject = 'Welcome';
        $this->data = compact('user');

        $this->deliver();
    }

    /**
     * Deliver the invitation email.
     *
     * @param  User $user
     * @return void
     */
    public function sendEmailInvitationTo(User $user) {
        $this->to = $user->email;
        $this->view = 'emails.invite';
        $this->subject = 'Invitation';
        $this->data = compact('user');

        $this->deliver();
    }

    /**
     * Deliver the email.
     *
     * @return void
     */
    public function deliver() {
        $this->mailer->send($this->view, $this->data, function ($message) {
            $message->from($this->from, 'DepotDash')
                    ->to($this->to)
                    ->subject($this->subject);
        });
    }

}
