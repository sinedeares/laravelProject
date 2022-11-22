@extends('layouts.master')
@section('title', 'Главная')
@section('content')
        <h1>Все товары</h1>

        <div class="row">
            @foreach($products as $product)
                @include('layouts.card', ['product' => $product])
            @endforeach
        </div>
@endsection
