<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #1a1a1a; }
        h1 { font-size: 16px; color: #102A54; margin-bottom: 4px; }
        .meta { color: #666; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: left; }
        thead th { background-color: #102A54; color: #fff; }
        tbody tr:nth-child(even) { background-color: #f8f9fb; }
    </style>
</head>
<body>
    <h1>Jueli Engineering Ltd &mdash; {{ $title }}</h1>
    <div class="meta">Generated {{ now()->format('d M Y, H:i') }}</div>

    <table>
        <thead>
            <tr>
                @foreach ($headings as $heading)
                    <th>{{ $heading }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headings) }}">No records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
