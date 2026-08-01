@extends('errors.layout')

@section('title', 'Service Unavailable')
@section('code', '503')
@section('icon', '…')
@section('heading', 'Service temporarily unavailable')

@section(
    'message',
    'The application is temporarily unavailable due to maintenance or a service interruption. Please try again shortly.'
)
