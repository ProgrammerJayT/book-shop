@extends('layouts.app')

@section('title', 'Books')

@section('content')
<div class="py-3 py-md-5 bg-light">
    <div class="container">
        <div class="row">
            <livewire:frontend.items.index :categories="$categories" :categoryById="$categoryById"/>
        </div>
    </div>
</div>
@endsection