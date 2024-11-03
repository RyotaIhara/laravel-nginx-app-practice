<!-- resources/views/items/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Items List</h1>
    <a href="{{ route('items.create') }}" class="btn btn-primary">Add New Item</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Amount</th>
                <th>Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->count }}</td>
                    <td>
                        <a href="{{ route('items.show', $item->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
