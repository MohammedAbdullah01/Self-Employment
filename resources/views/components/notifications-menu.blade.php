<li class="nav-item dropdown  ">

    <a class="nav-link" data-bs-toggle="dropdown" href="#">
        <i class="bi bi-bell fs-4">
            @if ($newNotificationsCount)
                <span
                    class="position-absolute top-5 start-80 translate-middle  bg-danger border border-light rounded-circle text-light"
                    style="margin-top: 9px;width: 18px;height: 18px; ">
                    <p class="text-center " style="font-size:small; margin-bottom:-2px;">{{ $newNotificationsCount }}</p>
                </span>
            @endif

        </i>
    </a>

    <ul class="dropdown-menu">

        @forelse($notifications as $notification)
            <li>

                <div class="card" style="width: 18rem;">

                    <div class="card-body">
                        <p class="card-title">

                            <img src="{{ $notification->data['img'] }}" width="30px" height="30" alt="Profile"
                                class="rounded-circle">

                            <a class="card-link"
                                href="{{ $notification->data['url'] }}?notify={{ $notification->id }}">
                                {{ $notification->data['title'] . $notification->data['name'] }}
                            </a>
                            {{ Str::limit($notification->data['body'], 33, '...') }}
                        </p>
                        <p class="card-text"><small
                                class="text-muted">{{ $notification->created_at->diffForHumans() }}</small></p>
                    </div>
                </div>
            </li>

        @empty

            <li>
                <p class="fw-bold text-danger text-center">
                    {{ 'There are no notifications at the moment :(' }}
                </p>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
        @endforelse
    </ul>
</li>
