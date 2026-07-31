@extends('errors.layout')

@section('code', '403')

@section('title', 'Access Denied')

@section(
    'message',
    $message ?? 'You do not have permission to access this page or perform this action.'
)
