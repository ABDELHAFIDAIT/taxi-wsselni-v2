@php
if(Auth::user()->role!='Admin'){
    abort(code: 403);
}
@endphp

@extends('layouts.app')
