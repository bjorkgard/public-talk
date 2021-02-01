@component('mail::message')
# Skicka ett tack till talaren

Följande talare har nyligen haft en föreläsning i församlingen.<br>
Om du vill skicka ett tack till honom kan du klicka på knappen nedanför och skriva en hälsning till honom.

@component('mail::table')
| | |
|:-|:-|
|__Datum__|{{$booking->date}}|
|__Föreläsning__|{{$booking->talk->full_theme}}|
|__Talare__|{{$booking->speaker->full_name}}|
|__Församling__|{{$booking->speaker->congregation}}|
|__E-post__|{{$booking->speaker->email}}|
|__Telefon__|{{$booking->speaker->phone}}|
@endcomponent

@component('mail::button', ['url' => $bookingLink])
Skicka ett tack
@endcomponent

@endcomponent