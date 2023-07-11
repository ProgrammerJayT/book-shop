@extends('layouts.app')

@section('title', 'Cart List')

@section('content')
    <livewire:frontend.cart.cart-show :categories="$categories"/>
@endsection