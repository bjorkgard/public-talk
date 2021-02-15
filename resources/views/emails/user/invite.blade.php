@component('mail::message')
# Församlingens föredragsbokningar

Du har fått en inbjudan till att kunna komma åt församlingens föredragsbokningar.

För att komma igång behöver du skapa ett personligt lösenord och sedan kan du logga in på applikationen.

@component('mail::button', ['url' => $inviteUrl])
Skapa ett lösenord
@endcomponent


Den här länken upphör att gälla om 1 dygn.

Med vänlig hälsning,<br>
{{ $user->name }}


@component('mail::subcopy')
Om du har problem med att klicka på knappen "Skapa ett lösenord", kopiera och klistra in webbadressen nedan till din webbläsare:<span class="break-all">[{{ $inviteUrl }}]({{ $inviteUrl }})</span>
@endcomponent

@endcomponent