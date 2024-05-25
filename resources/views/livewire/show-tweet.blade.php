<div>
    Show Teets
    <h3>
        {{ $content }}
    </h3>

    <form method="post" wire:submit.prevent="create">
        @csrf

        <input type="text" name="content" id="content" wire:model="content">
        @error('content')
            {{ $message }}
        @enderror
        <button type="submit">Criar Tweet</button>
    </form>


    @foreach ($tweets as $tweet)
        <p>
            {{-- {{ dd("storage/{$tweet->user->profile_photo_path}") }} --}}
            @if ($tweet->user->profile_photo_path)
                <img src="{{ url("storage/{$tweet->user->profile_photo_path}" )}}" alt="{{ $tweet->user->name }}">
            @else
                <img src="{{ url('imgs/no-image.png') }}" alt="{{ $tweet->user->name }}">
            @endif
            {{ $tweet->user->name }} -
            {{ $tweet->content }}

            @if ($tweet->likes->count() > 0)
                <a href="#" wire:click.prevent="unlike({{ $tweet->id }})">Descurtir</a>
            @else
                <a href="#" wire:click.prevent="like({{ $tweet->id }})"> Curtir</a>
            @endif
        </p>
    @endforeach

    <div>
        {{ $tweets->links() }}
    </div>
</div>
