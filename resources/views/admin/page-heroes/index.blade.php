@extends('layouts.admin')

@section('title', 'Page Heroes - Admin')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-white"><strong>Page Hero Banners</strong></div>

        <div class="card-body">
            <p class="text-muted small mb-3">The large banner at the top of each page. Leave the heading or text empty to hide it, and remove the custom image to go back to the default background. The Services page banner is managed under <strong>Services &rarr; Hero Slides</strong>.</p>
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th>Background</th>
                            <th>Heading</th>
                            <th>Text</th>
                            <th class="no-print">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($heroes as $hero)
                            <tr>
                                <td><strong>{{ $hero->page_label }}</strong></td>
                                <td>
                                    <img src="{{ $hero->image_url ?? asset(\App\Models\PageHero::DEFAULT_IMAGE) }}" alt="" class="img-thumbnail" width="110" height="60" style="object-fit: cover;">
                                    <div class="small text-muted">{{ $hero->image ? 'Custom image' : 'Default image' }}</div>
                                </td>
                                <td>{{ $hero->title ?: '—' }}</td>
                                <td>{{ Str::limit($hero->description, 70) ?: '—' }}</td>
                                <td class="no-print">
                                    <a href="{{ route('admin.page-heroes.edit', $hero) }}" class="btn btn-warning btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
