@component('mail::message')
# En talare är borttagen

En talare som är inbokad i er församling är borttagen.

@component('mail::table')
| | |
|-|:-|
|__Datum__|{{$booking->date}}|
|__Föreläsning__|{{$booking->talk->number . ', ' . $booking->talk->theme}}|
|__Talare__|{{$booking->speaker->firstname . ' ' . $booking->speaker->lastname}}|
|__Telefon__|{{$booking->speaker->phone}}|
|__E-post__|{{$booking->speaker->email}}|
@endcomponent

@component('mail::button', ['url' => config('app.url')])
Gå till applikationen
@endcomponent

@endcomponent