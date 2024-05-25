<div>
    <h1>Upload Photo</h1>
    <form action="#" wire:submit.prevent="storagePhoto"  >
        @csrf
        <input type="file"  wire:model="photo">
        @error('photo')
        {{ $message }}
    @enderror
        <button type="submit">Upload</button>
    </form>
</div>
