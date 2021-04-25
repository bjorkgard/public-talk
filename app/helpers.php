<?php

use App\Models\Booking;
use Carbon\Carbon;
use Spatie\CalendarLinks\Link;

function generateMapLink(Booking $booking)
{
  return 'https://www.google.com/maps/place/' . $booking->settings->congregation->address . ', ' . $booking->settings->congregation->zip . ' ' . $booking->settings->congregation->city;
}

function generateIcs(Booking $booking)
{
  $dateString = $booking->date . ' ' . $booking->time;
  $from = Carbon::createFromFormat('Y-m-d H:i:s', $dateString);
  $to = Carbon::createFromFormat('Y-m-d H:i:s', $dateString);
  $to->addMinutes(35);

  return Link::create('Föreläsning: ' . $booking->talk->full_theme, $from, $to)
    ->description(generateDescription($booking))
    ->address($booking->settings->congregation->address . ', ' . $booking->settings->congregation->zip . ' ' . $booking->settings->congregation->city);
}

function generateDescription(Booking $booking)
{
  $description = '';

  $description .= $booking->settings->congregation->name . '\n';
  $description .= $booking->settings->congregation->address . ', ' . $booking->settings->congregation->zip . ' ' . $booking->settings->congregation->city . '\n';
  $description .= '\nKontaktuppgifter:\n';
  $description .= $booking->user->name . '\n';
  $description .= $booking->user->email . '\n';
  $description .= $booking->user->phone . '\n';

  return $description;
}

function generateChairmanIcs(Booking $booking)
{
  $dateString = $booking->date . ' ' . $booking->time;
  $from = Carbon::createFromFormat('Y-m-d H:i:s', $dateString);
  $to = Carbon::createFromFormat('Y-m-d H:i:s', $dateString);
  $to->addMinutes(35);

  return Link::create('Ordförande till föreläsningen', $from, $to)
    ->description(generateChairmanDescription($booking))
    ->address($booking->settings->congregation->address . ', ' . $booking->settings->congregation->zip . ' ' . $booking->settings->congregation->city);
}

function generateChairmanDescription(Booking $booking)
{
  $talk = !is_null($booking->talk) ? $booking->talk->theme : $booking->custom_talk;
  $speaker = !is_null($booking->speaker) ? $booking->speaker->firstname . ' ' . $booking->speaker->lastname : $booking->custom_speaker;
  $congregation = !is_null($booking->speaker) ? $booking->speaker->congregation : '';
  $description = '';

  $description .= 'Sång: ' . $booking->song . '\n';
  $description .= 'Tema: ' . $talk . '\n';
  $description .= 'Talare: ' . $speaker . '\n';
  $description .= 'Församling: ' . $congregation;

  return $description;
}
