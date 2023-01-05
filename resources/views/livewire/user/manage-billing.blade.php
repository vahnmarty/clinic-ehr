<x-slot name="header">
    <div class="flex justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-white">Billing</h1>
        <div class="flex gap-3">
            <a href="{{ url('subscription') }}" class="btn-primary">Payment Details</a>
        </div>
    </div>
</x-slot>
@if (Auth::user()->subscribed())
    @livewire('user.manage-invoices')
@else
    @livewire('user.subscription-page')
@endif
