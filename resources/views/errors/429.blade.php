@extends('errors.layout')

@section('code', '429')

@section('title', 'Too Many Requests')

@section(
    'message',
    'You have submitted too many requests in a short period. Please wait a moment and try again.'
)
