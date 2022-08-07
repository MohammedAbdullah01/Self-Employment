@forelse ($categories as $category)
    <li><a class="dropdown-item"
            href="{{ route('front.show.projects.in.category', $category->slug) }}">{{ $category->name }}</a></li>
@empty
@endforelse
