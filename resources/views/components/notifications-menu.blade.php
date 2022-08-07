<a class=" list-inline-item mx-0  position-relative mt-1" type="button" data-bs-toggle="offcanvas"
    data-bs-target="#staticBackdrop" aria-controls="staticBackdrop" style="font-size: 18px">
    <i class="ti-bell"></i>
    <span class="translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">
        {{ $newNotificationsCount ?? '' }}
        <span class="visually-hidden">unread messages</span>
    </span>
</a>

<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel">{{ __('Notifications') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="list-group">
            @forelse($notifications as $notification)
                <a href="{{ $notification->data['url'] }}?notify={{ $notification->id }}"
                    class="list-group-item list-group-item-action " aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <span class="mb-1 ">
                            <img src="{{ asset('storage/users/' . $notification->data['img']) }}" height="30"
                                width="40" alt="Profile" class="rounded-circle">
                            {{ $notification->data['title'] }}
                            <span class="text-info">{{ $notification->data['name'] }}</span>
                        </span>

                    </div>
                    <p class="mb-1">{{ $notification->data['body'] }}</p>
                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                </a>
            @empty
                <span class="list-group-item list-group-item-action text-danger ">
                    <p class="mb-1">
                        {{ __('There are no notifications at the moment') }}
                    </p>
                </span>
            @endforelse
        </div>
    </div>
</div>
