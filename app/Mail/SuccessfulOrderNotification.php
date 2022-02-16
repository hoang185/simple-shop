<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuccessfulOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $content;
    public $item_price;
    public function __construct($content, $item_price)
    {
        $this->content = $content;
        $this->item_price = $item_price;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $content = $this->content;
        $item_price = $this->item_price;

        return $this->from('vuhuyhoang185@gmail.com')->subject(SUCCESS_ORDER_NOTI)->view('mail.order', compact('content', 'item_price'));
    }
}
