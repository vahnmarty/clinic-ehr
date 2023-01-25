<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Dashboard') }}
    </h2>
</x-slot>


<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

        <div>
            <h2 class="text-lg font-semibold text-gray-900">Upcoming appointments</h2>
            <div class="grid grid-cols-2">

                <div class="pr-8">
                    <ol x-data>
                        @forelse($appointments as $app)
                            <a href="{{ route('patient.show', $app->patient_id) }}"
                                class="relative flex py-6 space-x-6 rounded-md cursor-pointer hover:bg-gray-200 xl:static"
                                x-transition>
                                <img src="{{ $app['patient']['image_avatar'] }}" alt=""
                                    class="flex-none rounded-full h-14 w-14">
                                <div class="flex-auto">
                                    <h3 class="pr-10 font-semibold text-gray-900 xl:pr-0">
                                        {{ $app['patient']['full_name'] }}
                                    </h3>
                                    <dl class="flex flex-col mt-2 text-gray-500">
                                        <div class="flex items-start space-x-3">
                                            <dt class="mt-0.5">
                                                <span class="sr-only">Date</span>
                                                <!-- Heroicon name: mini/calendar -->
                                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </dt>
                                            <dd><time
                                                    datetime="{{ $app->appointment_Date?->toIso8601String() }}">{{ $app->appointment_date?->format('F d, Y  h:i a') }}</time>
                                            </dd>
                                        </div>
                                        <div
                                            class="flex items-start mt-2 space-x-3 xl:mt-0 xl:border-gray-400 xl:border-opacity-50">
                                            <dt class="mt-0.5">
                                                <span class="sr-only">Location</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5 text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                                </svg>

                                            </dt>
                                            <dd>{{ $app->visit_reason }}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </a>
                        @empty
                            <li>*No appointments scheduled today.</li>
                        @endforelse
                    </ol>
                </div>
                <div>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

    </div>
</div>


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.0.3/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialDate: '{{ $date }}',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                events: @json($events)

            });

            calendar.render();
        });
    </script>
@endpush
