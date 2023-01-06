<footer class="py-3 text-xs text-gray-400 bg-indigo-900">
    <div class="wrapper">
        <div class="flex justify-between">
            <p>Developed by 
                <a href="https://www.fortlewis.edu/academics/schools-departments/departments/sociology-human-services-department/faculty/waddell">@waddell</a> & <a href="https://vahnmarty.github.io/" target="_blank">@vahnmarty</a></p>
            <div>
                <a href="{{ config('app.url') }}" class="block">{{ config('app.name') }} &copy {{ date('Y') }}</a>
            </div>
            <div>
                <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div>
</footer>