@component('mail::message')
# Bokningsbekräftelse

Tack för att du vill hålla en föreläsning i vår församling.

Om du behöver kontakta oss så finns kontaktuppgifterna längst ner i mailet.


@component('mail::table')
| | |
|-|:-|
|__Datum__|{{$booking->date}}|
|__Sång__|{{$booking->song}}|
|__Föreläsning__|{{$booking->talk->full_theme}}|
|__Församling__|{{$booking->user->settings->congregation->name}}|
|__Adress__|{{$booking->user->settings->congregation->address}}, {{$booking->user->settings->congregation->zip}} {{$booking->user->settings->congregation->city}}|
|__Karta__|<a href="{!! $mapLink !!}">Hitta hit</a>|
@foreach($booking->user->settings->extra as $field)
|__{{$field['label']}}__|{{$field['value']}}|
@endforeach
@endcomponent

@component('mail::table')
| |Kontaktuppgifter|
|-|:-|
|__Namn__|{{$booking->user->name}}|
|__E-post__|{{$booking->user->email}}|
|__Telefon__|{{$booking->user->phone}}|
@endcomponent

@component('mail::button', ['url' => $calendarLink->ics()])
Ladda ner kalenderfil
@endcomponent

Välkommen<br>
{{ $booking->user->name }}, {{ $booking->user->settings->congregation->name }}
@endcomponent