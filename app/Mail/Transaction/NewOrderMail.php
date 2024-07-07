<?php

namespace App\Mail\Transaction;

use App\Models\Customer;
use App\Models\GeneralInfo;
use App\Models\MailHistory;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class NewOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $content;
    public $title;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $this->title = GeneralInfo::where('key', '=', 'mail_new_order_title')->first()->value;
        return new Envelope(
            subject: $this->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $transaction = Transaction::find($this->data);


        $content = GeneralInfo::where('key','=','mail_new_order_content')->first()->value;
        $content= str_replace('[CUSTOMER_NAME]',$transaction->customer->name,$content);
        $content= str_replace('[PAYMENT_MODEL_1]',explode(':',$transaction->paymentModel->model)[0],$content);
        $content= str_replace('[TOTAL_TRANSACTION]','Rp. ' .thousand_format($transaction->total_money),$content);
        $content= str_replace('[TOTAL]','Rp. '.thousand_format(explode(':',$transaction->paymentModel->model)[0]*$transaction->total_money/100),$content);
        $content= str_replace('[NO_INVOICE]',$transaction->uid,$content);
        $content= str_replace('[DATE]',$transaction->created_at->format('d/m/Y'),$content);
        $content = preg_replace("/[\n\r]/","<br>", $content);
        $this->content =  $content;

        MailHistory::create([
            'content' => $this->content,
            'title' => $this->title,
            'mail' => $transaction->customer->email,
            'model_id' => $transaction->customer_id,
            'model_type' => Customer::class,
            'type_mail' => 'attendance-remember',
        ]);

        return new Content(
            view: 'emails.new-order',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $transaction = Transaction::find($this->data);
        $data = [
            'transaction' => $transaction,
        ];
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.invoice', $data);
        $pdf->render();
        $output = $pdf->output();

        $content = GeneralInfo::where('key', '=', 'mail_new_order_file_name')->first()->value ?? '';
        $content = str_replace('[CUSTOMER_NAME]', $transaction->customer->name, $content);
        $content = str_replace('[PAYMENT_MODEL_1]', explode(':', $transaction->paymentModel->model)[0], $content);
        $content = str_replace('[TOTAL_TRANSACTION]', 'Rp. '.thousand_format($transaction->total_money), $content);
        $content = str_replace('[TOTAL]', 'Rp. '.thousand_format(explode(':', $transaction->paymentModel->model)[0] * $transaction->total_money / 100), $content);
        $content = str_replace('[NO_INVOICE]', $transaction->uid, $content);
        $content = str_replace('[DATE]', $transaction->created_at->format('d/m/Y'), $content);
        if ($content == '') {
            $content = 'invoice.pdf';
        }

        return [
            Attachment::fromData(fn () => $output, $content)->withMime('aplication/pdf'),
        ];
    }
}
