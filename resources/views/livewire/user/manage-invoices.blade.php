<div class="wrapper">

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Invoices</h1>
            </div>
        </div>
        <div class="flex flex-col mt-8">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Amount</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Currency</span>
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Status</span>
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Invoice Number
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date Created
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Download</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td
                                            class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                            {{ $invoice->total() }}
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500">
                                            <div class="inline-flex">USD</div>
                                        </td>
                                        <td class="px-3 py-4 text-sm">
                                            @if ($invoice->paid)
                                                <div class="inline-flex px-2 py-1 text-xs bg-green-200 rounded-lg">
                                                    Paid
                                                </div>
                                            @else
                                            @endif
                                        </td>
                                        <td class="px-3 py-4 text-sm">
                                            <p>{{ $invoice->number }}</p>
                                        </td>
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $invoice->date()->toFormattedDateString() }}</td>
                                        <td
                                            class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                                            <a href="#"
                                                class="text-indigo-600 hover:text-indigo-900">Download<span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
