@unless ($breadcrumbs->isEmpty())
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3 font-sans">
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="inline-flex items-center">
                    @if ($breadcrumb->url && !$loop->last)
                        <a href="{{ $breadcrumb->url }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors">
                            {{ $breadcrumb->title }}
                        </a>
                        <span class="mx-2 text-gray-900"> 
                            -> 
                        </span>
                    @else
                        <span class="text-sm font-medium text-gray-800">
                            {{ $breadcrumb->title }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endunless