<!-- resources/views/items/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Item Details</h1>
    <p><strong>ID:</strong> {{ $item->id }}</p>
    <p><strong>Item Name:</strong> {{ $item->item_name }}</p>
    <p><strong>Amount:</strong> {{ $item->amount }}</p>
    <p><strong>Count:</strong> {{ $item->count }}</p>
    <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a>
    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
@endsection
