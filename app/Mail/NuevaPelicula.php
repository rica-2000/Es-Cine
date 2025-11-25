<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\pelicula;

class NuevaPelicula extends Mailable
{
    use Queueable, SerializesModels;

    public pelicula $pelicula;
    public ?string $url;
    public ?string $poster;

    /**
     * Create a new message instance.
     */
    public function __construct(pelicula $pelicula, ?string $url = null, ?string $poster = null)
    {
        $this->pelicula = $pelicula;
        $this->url = $url;
        $this->poster = $poster;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Nueva película agregada')
            ->view('peliculaNotificacion')
            ->with([
                'pelicula' => $this->pelicula,
                'url' => $this->url,
                'poster' => $this->poster,
            ]);
    }
}
