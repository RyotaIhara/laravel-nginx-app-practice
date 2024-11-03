<!-- resources/views/items/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Item</h1>
    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" name="item_name" id="item_name" class="form-control" value="{{ $item->item_name }}" required>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{ $item->amount }}" required>
        </div>
        <div class="form-group">
            <label for="count">Count</label>
            <input type="number" name="count" id="count" class="form-control" value="{{ $item->count }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
