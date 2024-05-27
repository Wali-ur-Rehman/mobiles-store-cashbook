<div class="card">
    {{-- <div class="container row tex-center pt-3">
        <div class="col-sm-6 col-lg-1"></div>
        <div class="col-sm-6 col-lg-2">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                    
                        <div class="col">
                            <div class="font-weight-medium">
                                Rs {{$sums->total_purchase}} Stock
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-2">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                    
                        <div class="col">
                            <div class="font-weight-medium">
                                Rs {{$sums->total_sales}} Sales
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-2">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                    
                        <div class="col">
                            <div class="font-weight-medium">
                                Rs {{$sums->total_expense}} Expenses
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-2">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                    
                        <div class="col">
                            <div class="font-weight-medium">
                                Rs {{$sums->total_credit}} Credit
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-2">
            <div class="card card-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                    
                        <div class="col">
                            <div class="font-weight-medium">
                                Rs {{$sums->total_debit}} Debit
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Cashbook') }}
            </h3>
        </div>
        <div class="card-actions btn-group">
            @if(!request()->type || request()->type=="Purchase")
            <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#modal-stock">
                {{ __('Add Purchase') }}
            </button>
            @endif
            @if(!request()->type || request()->type=="Sales")

            <button type="button" class="btn btn-primary  m-1" data-bs-toggle="modal" data-bs-target="#modal-sales">
                {{ __('Add Sale') }}
            </button>
            @endif

            @if(!request()->type || request()->type=="Expense")

            <button type="button" class="btn btn-primary  m-1" data-bs-toggle="modal" data-bs-target="#modal-expense">
                {{ __('Add Expense') }}
            </button>
            @endif

            @if(!request()->type || request()->type=="Debit" || request()->type=="Credit" )

            <button type="button" class="btn btn-primary  m-1" data-bs-toggle="modal" data-bs-target="#modal-debit-credit">
                {{ __('Add Ddebit/Credit') }}
            </button>
            @endif

        </div>
    </div>

    <div class="card-body border-bottom py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="text-secondary me-2">
                    Show
                    <div class="mx-2 d-inline-block">
                        <select wire:model.live="perPage" class="form-select" aria-label="result per page">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                    entries
                </div>
                <div class="text-secondary ms-2">
                    Start Date:
                    <div class="ms-2 d-inline-block">
                        <input type="date" wire:model.live="startDate" class="form-control" aria-label="Start date">
                    </div>
                </div>
                <div class="text-secondary ms-2">
                    End Date:
                    <div class="ms-2 d-inline-block">
                        <input type="date" wire:model.live="endDate" class="form-control" aria-label="End date">
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="text-secondary">
                    Search:
                    <div class="ms-2 d-inline-block">
                        <input type="text" wire:model.live="search" class="form-control" aria-label="Search invoice">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <x-spinner.loading-spinner />

    <div class="table-responsive">
        <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle text-center">
                        {{ __('Name') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Amount(Rs)') }}
                    </th>
                    <th class="align-middle text-center ">
                        {{ __('Type') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Trnsaction Date') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Description') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td class="align-middle text-center">
                            {{ $transaction->name }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $transaction->amount }} 
                        </td>
                        <td class="align-middle text-center">
                            {{ $transaction->type }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $transaction->transaction_date }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $transaction->description }}
                        </td>
                        <td class="align-middle text-center" style="width: 10%">
                            <x-button.show class="btn-icon"
                                route="{{ route('transactions.show', $transaction->id) }}" />
                            <x-button.edit class="btn-icon"
                                route="{{ route('transactions.edit', $transaction->id) }}" />
                            {{-- <x-button.delete class="btn-icon" route="{{ route('transactions.destroy', $transaction->id) }}"
                                onclick="return confirm('Are you sure to delete transaction {{ $transaction->name }} ?')" /> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="7">
                            No results found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Showing <span>{{ $transactions->firstItem() }}</span>
            to <span>{{ $transactions->lastItem() }}</span> of <span>{{ $transactions->total() }}</span> entries
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $transactions->links() }}
        </ul>
    </div>
    <div class="modal modal-blur fade" id="modal-stock" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form method="POST" action="">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Stock</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="transaction_date" class="form-label required"> {{ __('Date') }} </label>
                                    <input type="date" id="transaction_date" name="transaction_date" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label required"> {{ __('Name') }} </label>
                                    <input type="text" id="name" name="name" class="form-control" required>
                                </div>
                            </div>
                            <input type="text" id="type" name="type" class="form-control" value="Purchase" hidden>
                            
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="quantity" class="form-label"> {{ __('Quantity') }} </label>
                                    <input type="text" id="quantity" value="1" min="1" name="quantity" class="form-control" required>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount" class="form-label required"> {{ __('Amount') }} </label>
                                    <input type="number" id="amount" name="amount" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="supplier_id" class="form-label"> Supplier </label>
                                <select name="supplier_id" id="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror">
                                    <option value="">Select a Supplier:</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" @if(old('supplier_id') == $supplier->id) selected="selected" @endif>
                                        {{ $supplier->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="seller_name" class="form-label"> {{ __('Seller Name') }} </label>
                                    <input type="text" id="seller_name" name="seller_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="seller_cnic" class="form-label"> {{ __('Seller CNIC') }} </label>
                                    <input type="text" id="seller_cnic" name="seller_cnic" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="imei_number_1" class="form-label"> {{ __('IMEI Number 1') }} </label>
                                    <input type="text" id="imei_number_1" name="imei_number_1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="imei_number_2" class="form-label"> {{ __('IMEI Number 2') }} </label>
                                    <input type="text" id="imei_number_2" name="imei_number_2" class="form-control">
                                </div>
                            </div>
                           
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="trasaction_type" class="form-label required">
                                        {{ __('Transaction Type') }}
                                    </label>

                                    <select name="trasaction_type" id="trasaction_type"
                                        class="form-select @error('type') is-invalid @enderror">
                                        <option value="Cash">Cash</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label for="description" class="form-label"> {{ __('Description') }} </label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal"> {{ __('Cancel') }} </button>
                        <button type="submit" class="btn btn-primary"> {{ __('Save') }} </button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-sales" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form method="POST" action="">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Add Sales
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="date" class="form-label required">
                                        {{ __('Date') }}
                                    </label>
                                    <input type="date" id="transaction_date" name="transaction_date"
                                        class="form-control" value="{{ now()->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label required">
                                        {{ __('Name') }}
                                    </label>

                                    <input type="text" id="number" name="name" class="form-control" required>
                                </div>
                            </div>
                            <input type="text" name="type" value="Sales" hidden>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount" class="form-label required">
                                        {{ __('Amount') }}
                                    </label>

                                    <input type="number" name="amount" id="amount" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="product_id" class="form-label"> Products </label>
                                <select name="product_id" id="product_id" required class="form-select @error('product_id') is-invalid @enderror">
                                    <option value="">Select a Product:</option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}" @if(old('product_id') == $product->id) selected="selected" @endif>
                                        {{ $product->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>

                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="trasaction_type" class="form-label required">
                                        {{ __('Transaction Type') }}
                                    </label>

                                    <select name="trasaction_type" id="trasaction_type"
                                        class="form-select @error('type') is-invalid @enderror">
                                        <option value="Cash">Cash</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label for="description" class="form-label"> {{ __('Description') }} </label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-expense" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form method="POST" action="">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Add Credit / Debit
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="date" class="form-label required">
                                        {{ __('Date') }}
                                    </label>
                                    <input type="date" id="transaction_date" name="transaction_date"
                                        class="form-control" value="{{ now()->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label required">
                                        {{ __('Name') }}
                                    </label>

                                    <input type="text" id="number" name="name" class="form-control" required>
                                </div>
                            </div>
                            <input type="text" name="type" value="Expense" hidden>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount" class="form-label required">
                                        {{ __('Amount') }}
                                    </label>

                                    <input type="number" name="amount" id="amount" class="form-control" required>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exense_type" class="form-label required">
                                        {{ __('Expense Type') }}
                                    </label>

                                    <select name="exense_type" id="exense_type"
                                        class="form-select @error('type') is-invalid @enderror">
                                        <option value="Personal">Personal</option>
                                        <option value="Shop">Shop</option>
                                        <option value="House">House</option>
                                        <option value="Other">Other</option>
                                    </select>

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="trasaction_type" class="form-label required">
                                        {{ __('Transaction Type') }}
                                    </label>

                                    <select name="trasaction_type" id="trasaction_type"
                                        class="form-select @error('type') is-invalid @enderror">
                                        <option value="Cash">Cash</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label for="description" class="form-label"> {{ __('Description') }} </label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-debit-credit" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form method="POST" action="">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Add Credit / Debit
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="date" class="form-label required">
                                        {{ __('Date') }}
                                    </label>
                                    <input type="date" id="transaction_date" name="transaction_date"
                                        class="form-control" value="{{ now()->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label required">
                                        {{ __('Name') }}
                                    </label>

                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount" class="form-label required">
                                        {{ __('Amount') }}
                                    </label>

                                    <input type="number" id="number" name="amount" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label required">
                                        {{ __('Debit / Credit ') }}
                                    </label>

                                    <select name="type" id="type"
                                        class="form-select @error('type') is-invalid @enderror">
                                        <option value="Debit">Debit</option>
                                        <option value="Credit">Credit</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="supplier_id" class="form-label"> Supplier </label>
                                <select name="supplier_id" id="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror">
                                    <option value="">Select a Supplier:</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" @if(old('supplier_id') == $supplier->id) selected="selected" @endif>
                                        {{ $supplier->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="trasaction_type" class="form-label required">
                                        {{ __('Transaction Type') }}
                                    </label>

                                    <select name="trasaction_type" id="trasaction_type"
                                        class="form-select @error('type') is-invalid @enderror">
                                        <option value="Cash">Cash</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label for="description" class="form-label"> {{ __('Description') }} </label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
