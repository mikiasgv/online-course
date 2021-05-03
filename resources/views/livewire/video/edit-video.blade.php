<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="update">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message')}}
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label" for="title">Video Title</label>
                            <input type="text"  id="title" wire:model="video.title" class="form-control">
                        </div>

                        @error('video.title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label" for="description">Video Description</label>
                            <textarea wire:model="video.description"  id="description" cols="6" rows="6" class="form-control"></textarea>
                        </div>
                        @error('video.description')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="mb-3">
                            <label class="form-label" for="visibility">Video Visibility</label>
                            <select class="form-select" name="visibility" id="visibility" wire:model="video.visibility">
                                <option value="private">Private</option>
                                <option value="public">Public</option>
                                <option value="unlisted">Unlisted</option>
                            </select>
                        </div>
                        @error('video.visibility')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
