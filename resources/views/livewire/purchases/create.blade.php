<div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8 flex items-end justify-between gap-4">
        <div>
            <p class="text-sm font-medium text-primary">{{ __('ui.purchases') }}</p>
            <h1 class="mt-1 text-3xl font-bold tracking-tight">{{ __('ui.create_purchase') }}</h1>
            <p class="mt-2 text-sm text-base-content/60">{{ __('ui.add_product_emi') }}</p>
        </div>
        <a href="{{ route('purchases.index') }}" wire:navigate class="btn btn-ghost">{{ __('ui.cancel') }}</a>
    </div>

    @if ($errors->has('form'))
        <div class="alert alert-error mb-6">{{ $errors->first('form') }}</div>
    @endif

    <form wire:submit="store" class="space-y-6">
        <div class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-2xl border border-base-300 bg-base-100 p-6 shadow-sm">
                <h2 class="text-lg font-semibold">{{ __('ui.customer') }}</h2>
                <label class="form-control mt-4 w-full">
                    <span class="label-text">{{ __('ui.search_customer') }}</span>
                    <input wire:model.live.debounce.300ms="customerSearch" type="search" class="input input-bordered w-full" placeholder="{{ __('ui.search_customer') }}">
                </label>
                <label class="form-control mt-4 w-full">
                    <span class="label-text">{{ __('ui.select_customer') }}</span>
                    <select wire:model="customer_id" class="select select-bordered w-full">
                        <option value="">{{ __('ui.choose_customer') }}</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->customer_id }} - {{ $customer->customer_name }}</option>
                        @endforeach
                    </select>
                    @error('customer_id') <span class="label-text-alt text-error">{{ $message }}</span> @enderror
                </label>
            </div>

            <div class="rounded-2xl border border-base-300 bg-base-100 p-6 shadow-sm">
                <h2 class="text-lg font-semibold">{{ __('ui.product') }}</h2>
                <label class="form-control mt-4 w-full">
                    <span class="label-text">{{ __('ui.product') }}</span>
                    <select wire:model.live="product_id" class="select select-bordered w-full">
                        <option value="">{{ __('ui.choose_product') }}</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                    @error('product_id') <span class="label-text-alt text-error">{{ $message }}</span> @enderror
                </label>
                <label class="form-control mt-4 w-full">
                    <span class="label-text">{{ __('ui.available_model') }}</span>
                    <select wire:model="model_id" class="select select-bordered w-full" @disabled(empty($models))>
                        <option value="">{{ empty($models) ? __('ui.choose_product_first') : __('ui.choose_model') }}</option>
                        @foreach ($models as $model)
                            <option value="{{ $model['id'] }}">{{ $model['model_name'] }} ({{ $model['qty'] }} available)</option>
                        @endforeach
                    </select>
                    @error('model_id') <span class="label-text-alt text-error">{{ $message }}</span> @enderror
                </label>
            </div>
        </div>

        <div class="rounded-2xl border border-base-300 bg-base-100 p-6 shadow-sm">
            <h2 class="text-lg font-semibold">{{ __('ui.payment_plan') }}</h2>
            <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <label class="form-control"><span class="label-text">{{ __('ui.sales_price') }}</span><input wire:model="sales_price" type="number" min="0" step="0.01" class="input input-bordered">@error('sales_price') <span class="label-text-alt text-error">{{ $message }}</span> @enderror</label>
                <label class="form-control"><span class="label-text">{{ __('ui.net_price') }}</span><input wire:model="net_price" type="number" min="0" step="0.01" class="input input-bordered">@error('net_price') <span class="label-text-alt text-error">{{ $message }}</span> @enderror</label>
                <label class="form-control"><span class="label-text">{{ __('ui.down_payment') }}</span><input wire:model="down_price" type="number" min="0" step="0.01" class="input input-bordered">@error('down_price') <span class="label-text-alt text-error">{{ $message }}</span> @enderror</label>
                <label class="form-control"><span class="label-text">{{ __('ui.emi_months') }}</span><input wire:model="emi_plan" type="number" min="1" class="input input-bordered">@error('emi_plan') <span class="label-text-alt text-error">{{ $message }}</span> @enderror</label>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary min-w-40" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="store">{{ __('ui.save_purchase') }}</span>
                <span wire:loading wire:target="store">{{ __('ui.saving') }}</span>
            </button>
        </div>
    </form>
</div>