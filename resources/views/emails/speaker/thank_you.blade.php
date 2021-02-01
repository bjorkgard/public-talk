@component('mail::message')
# Tack för din föreläsning

{{$greeting}}

Med broderliga hälsningar,<br>
{{ $booking->user->settings->congregation->name }}
@endcomponent