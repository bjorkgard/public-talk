@component('mail::message')
# En föreläsning är borttagen

En föreläsning som är inbokad i er församling har tagits bort på jw.org.

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