@extends('errors.layout')

@section('code', $statusCode ?? 'Error')

@section('title', $title ?? 'Request Error')

@section(
    'message',
    $message ?? 'The requested operation could not be completed.'
)
