<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class BlogPosted extends Mailable
{
    public function __construct(public User $user, public Post $post)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'admin@example.net',
            to: $this->user->email,
            subject: 'Blog Posted',  // ユーザー本人に送信する
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'emails.blog-posted',
        );
    }
}
