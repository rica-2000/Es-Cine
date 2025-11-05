<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ __('Notificación de Nueva Película') }} — {{ config('app.name') }}</title>
    <!--[if mso]>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
</head>
<body style="margin:0;padding:0;background-color:#f5f7fb;">
    <!-- Preheader (oculto) -->
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;color:transparent;">
        {{ __('Se agregó una nueva película:') }} {{ optional($pelicula)->title ?? __('nueva') }}
    </div>

    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#f5f7fb;">
        <tr>
            <td align="center" style="padding:24px 12px;">
                <!-- Contenedor principal -->
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="600" style="max-width:600px;width:100%;background:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 4px 18px rgba(17,24,39,.08);">
                    <!-- Header -->
                    <tr>
                        <td style="background:#111827;padding:20px 24px;" align="left">
                            <span style="font-family:Segoe UI,Arial,sans-serif;font-size:14px;letter-spacing:.08em;color:#9ca3af;text-transform:uppercase;">{{ config('app.name', 'Cine') }}</span>
                            <div style="font-family:Segoe UI,Arial,sans-serif;color:#ffffff;font-size:20px;font-weight:600;margin-top:6px;">
                                {{ __('Nueva película disponible') }}
                            </div>
                        </td>
                    </tr>

                    <!-- Hero / Título -->
                    <tr>
                        <td style="padding:28px 24px 8px 24px;" align="left">
                            <div style="font-family:Segoe UI,Arial,sans-serif;color:#111827;font-size:22px;line-height:1.3;font-weight:700;">
                                {{ optional($pelicula)->title ?? __('¡Tenemos un nuevo estreno!') }}
                            </div>
                            <div style="font-family:Segoe UI,Arial,sans-serif;color:#6b7280;font-size:14px;line-height:1.6;margin-top:8px;">
                                {{ __('¡Hola! Se ha agregado una nueva película a nuestra cartelera.') }}
                            </div>
                        </td>
                    </tr>

                    <!-- Imagen (opcional) -->
                    @php
                        $poster = $poster ?? ($pelicula->poster_url ?? ($pelicula->poster ?? null) ?? null);
                    @endphp
                    @if(!empty($poster))
                        <tr>
                            <td align="center" style="padding:8px 24px 0 24px;">
                                <img src="{{ $poster }}" alt="Poster" width="552" style="display:block;border-radius:10px;width:100%;max-width:552px;height:auto;border:1px solid #e5e7eb;">
                            </td>
                        </tr>
                    @endif

                    <!-- Detalles -->
                    <tr>
                        <td style="padding:16px 24px 0 24px;" align="left">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:separate;border-spacing:0 10px;">
                                @if(optional($pelicula)->title)
                                <tr>
                                    <td style="font-family:Segoe UI,Arial,sans-serif;font-size:13px;color:#6b7280;width:160px;">{{ __('Título') }}</td>
                                    <td style="font-family:Segoe UI,Arial,sans-serif;font-size:15px;color:#111827;font-weight:600;">{{ $pelicula->title }}</td>
                                </tr>
                                @endif
                                @if(optional($pelicula)->director)
                                <tr>
                                    <td style="font-family:Segoe UI,Arial,sans-serif;font-size:13px;color:#6b7280;width:160px;">{{ __('Director') }}</td>
                                    <td style="font-family:Segoe UI,Arial,sans-serif;font-size:15px;color:#111827;">{{ $pelicula->director }}</td>
                                </tr>
                                @endif
                                @if(optional($pelicula)->genre)
                                <tr>
                                    <td style="font-family:Segoe UI,Arial,sans-serif;font-size:13px;color:#6b7280;width:160px;">{{ __('Género') }}</td>
                                    <td style="font-family:Segoe UI,Arial,sans-serif;font-size:15px;color:#111827;">{{ $pelicula->genre }}</td>
                                </tr>
                                @endif
                                @if(optional($pelicula)->duration)
                                <tr>
                                    <td style="font-family:Segoe UI,Arial,sans-serif;font-size:13px;color:#6b7280;width:160px;">{{ __('Duración') }}</td>
                                    <td style="font-family:Segoe UI,Arial,sans-serif;font-size:15px;color:#111827;">{{ $pelicula->duration }} {{ __('min') }}</td>
                                </tr>
                                @endif
                            </table>
                        </td>
                    </tr>

                    <!-- CTA -->
                    @php
                        $ctaUrl = $url ?? (isset($pelicula) && isset($pelicula->id) ? (function_exists('route') ? route('peliculas.show', $pelicula->id) : null) : null) ?? config('app.url');
                    @endphp
                    <tr>
                        <td align="left" style="padding:20px 24px 28px 24px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" bgcolor="#e11d48" style="border-radius:10px;">
                                        <a href="{{ $ctaUrl }}" style="display:inline-block;padding:12px 20px;font-family:Segoe UI,Arial,sans-serif;font-size:14px;font-weight:700;color:#ffffff;text-decoration:none;">
                                            {{ __('Ver detalles') }}
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <div style="font-family:Segoe UI,Arial,sans-serif;color:#6b7280;font-size:12px;margin-top:10px;">
                                {{ __('Si el botón no funciona, copia y pega este enlace en tu navegador:') }}<br>
                                <a href="{{ $ctaUrl }}" style="color:#2563eb;text-decoration:underline;">{{ $ctaUrl }}</a>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f9fafb;padding:18px 24px;" align="left">
                            <div style="font-family:Segoe UI,Arial,sans-serif;color:#6b7280;font-size:12px;line-height:1.6;">
                                © {{ date('Y') }} {{ config('app.name', 'Cine') }}. {{ __('Todos los derechos reservados.') }}
                                <br>
                                <span style="color:#9ca3af;">{{ __('Este es un mensaje automático, por favor no respondas a este correo.') }}</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Responsive helper (limitado por clientes de correo) -->
    <div style="display:none;white-space:nowrap;font:15px courier;line-height:0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
</body>
</html>