@component('mail::message')
# Nieuw bericht ontvangen

**Naam:** {{ $messageData->name }}  
**Email:** {{ $messageData->email }}  
**Onderwerp:** {{ $messageData->subject ?? '-' }}

**Bericht:**  
{{ $messageData->message }}

@endcomponent
