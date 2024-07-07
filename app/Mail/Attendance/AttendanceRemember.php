<?php

namespace App\Mail\Attendance;

use App\Models\GeneralInfo;
use App\Models\MailHistory;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AttendanceRemember extends Mailable
{
    use Queueable, SerializesModels;

    public $userId;

    public $content;

    public $title;

    /**
     * Create a new message instance.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $this->title = GeneralInfo::where('key', '=', 'mail_attendance_remember_title')->first()->value;

        return new Envelope(
            subject: $this->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $user = User::find($this->userId);

        $content = GeneralInfo::where('key', '=', 'mail_attendance_remember_content')->first()->value;
        $content = str_replace('[EMPLOYEE_NAME]', $user->name, $content);

        $content = preg_replace("/[\n\r]/", '<br>', $content);
        $this->content = $content;

        MailHistory::create([
            'content' => $this->content,
            'title' => $this->title,
            'mail' => $user->email,
            'model_id' => $this->userId,
            'model_type' => User::class,
            'type_mail' => 'attendance-remember',
        ]);

        return new Content(
            view: 'emails.attendance-remember',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
