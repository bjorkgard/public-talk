@component('mail::message')
# Avbokad föreläsning

Din inbokade föreläsning {{$date}} har blivit avbokad.


Med broderliga hälsningar<br>
{{ $user->settings->congregation->name }}<br>
{{ $user->name }}, {{ $user->phone}}
@endcomponent