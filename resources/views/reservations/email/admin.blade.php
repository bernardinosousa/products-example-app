<x-mail::message>
# Booking nº {{ $reservation->id }}
 
User: {{ $reservation->user->name }} | {{ $reservation->user->email }}  
Product: {{ $reservation->product->name }}  
Quantity Booked: {{ $reservation->quantity }}  
Quantity Current: {{ $reservation->product->quantity }}  
Date: {{ $reservation->created_at->format('d/m/Y H:i:s') }}
 
{{-- <x-mail::button :url="$url">
View Booking
</x-mail::button>--}}
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>