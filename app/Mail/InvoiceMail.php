<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $customerName = $this->booking->bookingDetail->nama ?? $this->booking->user->name ?? 'Guest';
        
        return new Envelope(
            subject: 'Invoice Pembayaran Pineus Tilu - ' . $customerName,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice',
            with: [
                'booking' => $this->booking,
                'customerName' => $this->booking->bookingDetail->nama ?? $this->booking->user->name ?? 'Guest',
                'invoiceNumber' => $this->booking->payment->order_id ?? $this->booking->invoice_number ?? 'INV-' . str_pad($this->booking->id, 6, '0', STR_PAD_LEFT),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // Generate PDF invoice
        $pdf = Pdf::loadView('invoice', ['booking' => $this->booking]);
        $pdf->setPaper('A4', 'landscape');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans',
            'dpi' => 150,
            'defaultPaperSize' => 'A4',
            'chroot' => public_path(),
        ]);

        $invoiceNumber = $this->booking->payment->order_id ?? $this->booking->invoice_number ?? 'INV-' . str_pad($this->booking->id, 6, '0', STR_PAD_LEFT);
        $fileName = 'invoice-' . $invoiceNumber . '.pdf';

        return [
            Attachment::fromData(fn () => $pdf->output(), $fileName)
                ->withMime('application/pdf')
        ];
    }
}
