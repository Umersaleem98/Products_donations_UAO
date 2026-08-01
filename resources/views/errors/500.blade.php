@extends('errors.layout')

@section('title', 'Server Error')
@section('code', '500')
@section('icon', '!')
@section('heading', 'Something went wrong')

@section(
    'message',
    'An unexpected error occurred while processing your request. The issue has been recorded. Please try again later.'
)
