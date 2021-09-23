@component('mail::message')
# Ordförande

Du har blivit utsedd till ordförande för följande föreläsning.

@if(isset($booking->settings->chairman->message))
{{$booking->settings->chairman->message}}
@endif

@if($booking->reminder)

@if(isset($booking->settings->chairman->reminder))
{{$booking->settings->chairman->reminder}}
@else
Talaren har fått en automatisk påminnelse
@endif

@else

@if(isset($booking->settings->chairman->noReminder))
{{$booking->settings->chairman->noReminder}}
@else
Talaren har inte fått en automatisk påminnelse
@endif

@endif

@component('mail::table')
| | |
|-|:-|
|__Datum__|{{$booking->date}}|
|__Tid__|{{substr($booking->time, 0, strrpos( $booking->time, ':'))}}|
|__Sång__|{{$booking->song}}|
|__Föreläsning__|{{$booking->talk ? $booking->talk->theme : $booking->custom_talk}}|
|__Talare__|{{$booking->speaker ? $booking->speaker->firstname . ' ' . $booking->speaker->lastname : $booking->custom_speaker}}|
|__Telefon__|{{$booking->speaker ? $booking->speaker->formated_phone : ''}}|
|__Församling__|{{$booking->speaker ? $booking->speaker->congregation : ''}}|
@endcomponent

@component('mail::button', ['url' => $calendarLink->ics()])
Ladda ner kalenderfil
@endcomponent

Med vänlig hälsning<br>
{{ $booking->user->name }}
@endcomponent