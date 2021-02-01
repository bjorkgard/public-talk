@component('mail::message')
# Ordförande

Du har blivit utsedd till ordförande för följande föreläsning.


@component('mail::table')
| | |
|-|:-|
|__Datum__|{{$booking->date}}|
|__Sång__|{{$booking->song}}|
|__Föreläsning__|{{$booking->talk->theme}}|
|__Talare__|{{$booking->speaker->firstname}} {{$booking->speaker->lastname}}|
|__Församling__|{{$booking->speaker->congregation}}|
@endcomponent

@component('mail::button', ['url' => $calendarLink->ics()])
Ladda ner kalenderfil
@endcomponent

Med vänlig hälsning<br>
{{ $booking->user->name }}
@endcomponent