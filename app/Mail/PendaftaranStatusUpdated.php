<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\PendaftaranKkn;

class PendaftaranStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftaran;
    public $statusLama;
    public $statusBaru;
    public $catatanAdmin;

    /**
     * Create a new message instance.
     */
    public function __construct(PendaftaranKkn $pendaftaran, $statusLama, $statusBaru, $catatanAdmin = null)
    {
        $this->pendaftaran = $pendaftaran;
        $this->statusLama = $statusLama;
        $this->statusBaru = $statusBaru;
        $this->catatanAdmin = $catatanAdmin;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = 'Update Status Pendaftaran KKN International';
        
        // Customize subject berdasarkan status
        if ($this->statusBaru == 'diterima') {
            $subject = '🎉 Selamat! Anda Diterima KKN International';
        } elseif ($this->statusBaru == 'ditolak') {
            $subject = 'Pemberitahuan Status Pendaftaran KKN International';
        } elseif ($this->statusBaru == 'diproses') {
            $subject = '📋 Pendaftaran KKN Anda Sedang Diproses';
        }
        
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pendaftaran-status-updated',
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