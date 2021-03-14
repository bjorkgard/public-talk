@component('mail::message')
# Ordförande

Du har blivit utsedd till ordförande för följande föreläsning.

@if(!$booking->reminder)
Talaren har inte fått någon automatisk påminnelse!
@endif

@component('mail::table')
| | |
|-|:-|
|__Datum__|{{$booking->date}}|
|__Tid__|{{substr($booking->time, 0, strrpos( $booking->time, ':'))}}|
|__Sång__|{{$booking->song}}|
|__Föreläsning__|{{$booking->talk->theme}}|
|__Talare__|{{$booking->speaker->firstname}} {{$booking->speaker->lastname}}|
|__Telefon__|{{$booking->speaker->formated_phone}}|
|__Församling__|{{$booking->speaker->congregation}}|
@endcomponent

@component('mail::button', ['url' => $calendarLink->ics()])
Ladda ner kalenderfil
@endcomponent

Med vänlig hälsning<br>
{{ $booking->user->name }}
@endcomponent