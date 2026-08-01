@extends('errors.layout')

@section('title', 'Page Expired')
@section('code', '419')
@section('icon', '↻')
@section('heading', 'Your session has expired')

@section(
    'message',
    'Your session or security token has expired. Please return to the previous page, refresh it, and submit the form again.'
)
