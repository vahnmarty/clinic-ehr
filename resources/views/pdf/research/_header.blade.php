<header>
    <div class="grid grid-cols-2 gap-8">
        <div style="padding: 2em 0">
            <p style="width: 100%; display: table;">
                <span style="display: table-cell; width: 100px;">Patient: </span>
                <span
                    style="display: table-cell; border-bottom: 1px solid black;">{{ $research->patient->first_name }}
                    {{ $research->patient->last_name }}</span>
            </p>
        </div>
        <div style="padding: 2em 0">
            <p style="width: 100%; display: table;">
                <span style="display: table-cell; width: 100px;">Date: </span>
                <span
                    style="display: table-cell; border-bottom: 1px solid black;">{{ $research->created_at->format('F d Y') }}</span>
            </p>
        </div>
    </div>
</header>