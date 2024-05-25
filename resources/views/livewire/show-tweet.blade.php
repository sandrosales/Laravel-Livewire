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
        </p>
    @endforeach

    <div>
        {{ $tweets->links() }}
    </div>
</div>
