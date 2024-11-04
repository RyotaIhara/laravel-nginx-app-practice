<!-- resources/views/items/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Items List</h1>
    <a href="{{ route('items.create') }}" class="btn btn-primary">Add New Item</a>
    <table class="table">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Amount</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->getItemName() }}</td>
                    <td>{{ $item->getAmount() }}</td>
                    <td>{{ $item->getCount() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
