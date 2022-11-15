<div class="px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col mt-8">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <x-table.th class="text-center">{{ __('Picture') }}</x-table.th>
                                <x-table.th>{{ __('ID') }}</x-table.th>
                                <x-table.th>{{ __('First Name') }}</x-table.th>
                                <x-table.th>{{ __('Last Name') }}</x-table.th>
                                <x-table.th>{{ __('Date of Birth') }}</x-table.th>
                                <x-table.th>{{ __('Condition') }}</x-table.th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach (range(1, 10) as $rand)
                            @php
                            $faker = Faker\Factory::create();
                            @endphp
                                <tr>
                                    <x-table.td class="flex justify-center">
                                        <img src="{{ url('img/icons/apple.svg') }}" class="w-4 h-4 rounded-full"
                                            alt="">
                                    </x-table.td>
                                    <x-table.td>
                                        <p>#{{ rand(1000, 9999) }}</p>
                                    </x-table.td>
                                    <x-table.td>
                                        <p>{{ $faker->firstName }}</p>
                                    </x-table.td>
                                    <x-table.td>
                                        <p>{{ $faker->lastName }}</p>
                                    </x-table.td>
                                    <x-table.td>
                                        <p>{{ $faker->date() }}</p>
                                    </x-table.td>
                                    <x-table.td>
                                        
                                    </x-table.td>
                                    <x-table.td class="flex justify-end pr-8">
                                        <div class="flex gap-4">
                                            <a href="">
                                                <x-heroicon-s-pencil class="w-4 h-4 text-gray-500 hover:text-green-700"/>
                                            </a>
                                            <a href="">
                                                <x-heroicon-s-trash class="w-4 h-4 text-gray-500 hover:text-red-700"/>
                                            </a>
                                        </div>
                                    </x-table.td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
