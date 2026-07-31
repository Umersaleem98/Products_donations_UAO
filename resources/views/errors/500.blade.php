@extends('errors.layout')

@section('code', '500')

@section('title', 'Something Went Wrong')

@section(
    'message',
    'We could not complete your request due to an unexpected system error. The issue has been recorded.'
)

@if (!empty($reference))
    @section(
        'reference',
        'Error reference: ' . $reference
    )
@endif
