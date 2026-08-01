@extends('errors.layout')

@section('title', 'Page Not Found')
@section('code', '404')
@section('icon', '?')
@section('heading', 'Page not found')

@section(
    'message',
    'The page you requested could not be found. It may have been removed, renamed, or is temporarily unavailable.'
)
