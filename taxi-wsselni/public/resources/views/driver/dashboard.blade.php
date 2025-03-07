@php
if(Auth::user()->role != 'Driver'){
    abort(code: 403);
}
@endphp

@extends('layouts.app')