   @props(['user', 'size' => 'w-12 h-12'])

   {{-- User Profile Component --}}

   {{-- Display user profile image if exists, otherwise display default image --}}

   @if ($user->image)
       <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}" class="rounded-full {{ $size }}">
   @else
       <img src="/images/profile.png" alt="profile" class="{{ $size }} rounded-full">
   @endif
