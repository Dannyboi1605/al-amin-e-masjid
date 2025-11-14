@php
    $status = $volunteer->status;
    $event = $volunteer->event;
    $user = $volunteer->user;
@endphp

<p>Assalamualaikum {{ $user->name }},</p>

<p>Your application to volunteer for the event "{{ $event->title }}" has been updated to: <strong>{{ ucfirst($status) }}</strong>.</p>

@if($status === 'accepted')
    <p>Congratulations — you have been accepted as a volunteer. The admin will contact you with more details.</p>
@elseif($status === 'rejected')
    <p>We appreciate your interest, but your application was not accepted at this time.</p>
@else
    <p>Your application status is: {{ $status }}</p>
@endif

<p>Event: {{ $event->title }} — {{ $event->date->format('d M Y') }}</p>

<p>Thank you for your interest in helping our community.</p>

<p>— Al-Amin e-Masjid</p>
