@component('mail::message')
{{ __('Anda telah diundang untuk bergabung dengan tim :team!', ['team' => $invitation->team->name]) }}

@if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::registration()))
{{ __('Jika Anda belum mempunyai akun, Anda dapat membuatnya dengan mengklik tombol di bawah. Setelah membuat akun, Anda dapat mengklik tombol penerimaan undangan di email ini untuk menerima undangan tim:') }}

@component('mail::button', ['url' => route('register')])
{{ __('Buat Akun') }}
@endcomponent

{{ __('Jika Anda sudah memiliki akun, Anda dapat menerima undangan ini dengan mengklik tombol di bawah:') }}

@else
{{ __('Anda dapat menerima undangan ini dengan mengklik tombol di bawah:') }}
@endif


@component('mail::button', ['url' => $acceptUrl])
{{ __('Menerima undangan') }}
@endcomponent

{{ __('Jika Anda tidak menyangka akan menerima undangan ke tim ini, Anda dapat membuang email ini.') }}
@endcomponent
