@if($done)
<li class="relative {{ $last ? '' : 'pr-8 sm:pr-20 ' }}">
    <!-- Completed Step -->
    <div class="absolute inset-0 flex items-center" aria-hidden="true">
      <div class="h-0.5 w-full bg-indigo-600"></div>
    </div>
    <a href="#" class="relative flex items-center justify-center w-8 h-8 bg-indigo-600 rounded-full hover:bg-indigo-900">
      <!-- Heroicon name: mini/check -->
      <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
      </svg>

    <span class="absolute w-20 text-xs text-center -bottom-5">{{ $label }}</span>
    </a>
  </li>
@else
<li class="relative {{ $last ? '' : 'pr-8 sm:pr-20 ' }}">
    <!-- Upcoming Step -->
    <div class="absolute inset-0 flex items-center" aria-hidden="true">
      <div class="h-0.5 w-full bg-gray-200"></div>
    </div>
    <a href="{{ $link }}" class="relative flex items-center justify-center w-8 h-8 bg-white border-2 border-gray-300 rounded-full group hover:border-gray-400">
      <span class="h-2.5 w-2.5 rounded-full bg-transparent group-hover:bg-gray-300" aria-hidden="true"></span>
      <span class="absolute w-20 text-xs text-center -bottom-5">{{ $label }}</span>
    </a>
  </li>
@endif