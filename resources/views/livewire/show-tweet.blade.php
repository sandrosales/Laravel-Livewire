<div>
    Show Teets
    <h3>
        {{ $message }}
    </h3>
    @foreach ($tweets as $tweet)
        <p>
            {{ $tweet->user->name }} -
            {{ $tweet->content }}
        </p>
    @endforeach
</div>
