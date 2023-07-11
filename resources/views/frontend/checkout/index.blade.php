@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <livewire:frontend.checkout.checkout-show :categories="$categories"/>
@endsection