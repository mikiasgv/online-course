<div>
    @if($channel->image)
        <img src="{{ asset('images' . '/' . $channel->image)}}" alt="">
    @endif
    <form wire:submit.prevent="update">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message')}}
            </div>
        @endif
        <div class="form-group">
            <label for="name">Channel Name</label>
            <input type="text"  id="name" wire:model="channel.name" class="form-control">
        </div>

        @error('channel.name')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror

        <div class="form-group">
            <label for="slug">Channel Slug</label>
            <input type="text"  id="slug" wire:model="channel.slug" class="form-control">
        </div>

        @error('channel.slug')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror

        <div class="form-group">
            <label for="description">Channel Description</label>
            <textarea wire:model="channel.description"  id="description" cols="6" rows="6" class="form-control"></textarea>
        </div>
        @error('channel.description')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror

        <div class="form-group">
            <label for="image">Channel Image</label>
            @if ($image)
                Image Preview:
                <img class="thumbnail" src="{{ $image->temporaryUrl() }}">
            @endif
            <input type="file"  id="image" wire:model="image" class="form-control">
        </div>

        @error('channel.slug')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
