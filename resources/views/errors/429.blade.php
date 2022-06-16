@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Oops! 😖 Too Many Requests were sent the server'))
