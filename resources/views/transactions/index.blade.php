@extends('layouts.tabler')
@section('content')
    <div class="page-body">
        @if (!$transactions)
            <x-empty title="No products found" message="Try adjusting your search or filter to find what you're looking for."
                button_label="{{ __('Add your first Transaction') }}" button_route="{{ route('transactions.create') }}" />
        @else
            <div class="container-xl">
                <x-alert />
                @livewire('tables.transaction-table', ['suppliers' => $suppliers])
            </div>
        @endif
    </div>
@endsection
