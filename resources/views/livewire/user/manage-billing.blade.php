<x-slot name="header">
    <div class="flex justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-white">Billing</h1>
        <div>
            <a href="{{ url('checkout') }}" class="btn-primary">Subscribe Now</a>
        </div>
    </div>
</x-slot>

<div>
    @if($checkout)
    <div class="p-4 border-2 border-green-300 rounded-md shadow-lg bg-green-50">
        <div class="flex">
          <div class="flex-shrink-0">
            <!-- Heroicon name: mini/check-circle -->
            <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
            </svg>
          </div>
          <div class="ml-3">
            <h3 class="text-sm font-medium text-green-800">Order completed</h3>
            <div class="mt-2 text-sm text-green-700">
              <p>You have successfully subscribed!</p>
            </div>
          </div>
        </div>
      </div>
    @endif
</div>