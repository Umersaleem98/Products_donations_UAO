@extends('errors.layout')

@section('title', 'Too Many Requests')
@section('code', '429')
@section('icon', '!')
@section('heading', 'Too many requests')

@section(
    'message',
    'You have submitted too many requests in a short period. Please wait a moment before trying again.'
)
