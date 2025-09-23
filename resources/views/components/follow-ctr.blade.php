@props(['user'])
<div {{ $attributes }} x-data="{
    following: {{ $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
    followers: {{ $user->followers()->count() }},
    follow() {
        
        axios.post('/follow/{{ $user->id }}').then(res => {
                console.log(res.data)
                this.following = !this.following
                this.followers = res.data.followers
            })

            .catch(err => {
                console.error(err);
            })
    }
}" class="w-[320px] border-l px-8">
{{ $slot }}
</div>

