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
