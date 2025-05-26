<?php

namespace App\Mail;

use App\Models\Candidat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class RejectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $candidat;
    public $qrCodeBase64;
    /**
     * Create a new message instance.
     */
    public function __construct(Candidat $candidat)
    {
        $this->candidat = $candidat;
        // $qrData = "Nom: {$candidat->nom}\nEmail: {$candidat->email}\nTéléphone: {$candidat->telephone}";
        // $tmpPath = sys_get_temp_dir() . '/qr_' . uniqid() . '.png';
        // file_put_contents($tmpPath, QrCode::format('png')->size(200)->generate($qrData));
        // $this->qrCodePath = $tmpPath;

        $qrData = "Nom: {$candidat->nom}\nEmail: {$candidat->email}\nTéléphone: {$candidat->telephone}";
        // $pngData = QrCode::format('png')->size(200)->generate($qrData);
        // $this->qrCodeBase64 = base64_encode($pngData);
        $path = 'qrcodes/qr_' . uniqid() . '.png';
        Storage::disk('public')->put($path, QrCode::format('png')->size(200)->generate($qrData));
        $this->qrCodeBase64 = asset('storage/' . $path);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'CANDIDATURE REJETÉE',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reject_email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // \Illuminate\Mail\Mailables\Attachment::fromPath($this->qrCodePath)
            //     ->as('qrcode.png')
            //     ->withMime('image/png')
        ];
    }
}
