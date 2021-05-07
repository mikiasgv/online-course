<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach ($videos as $video)
                <div class="card my-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="w-25 mr-4">
                            <img src="{{asset($video->thumbnail) }}" class="img-fluid img-thumbnail" alt="">
                        </div>
                        <div class="w-75">
                            <h5>{{$video->title}}</h5>
                            <p class="text-truncate">{{$video->description}}</p>
                        </div>
                        <div class="w-25">
                            {{$video->visibility}}
                        </div>
                        <div class="w-25">
                            {{$video->created_at->format('d/m/Y')}}
                        </div>
                        @can('delete', $video)
                            <div class="w-25">
                                <a class="btn btn-light btn-sm" href="{{route('video.edit', ['channel' => auth()->user()->channel, 'video' => $video->uid])}}">Edit</a>
                                <button wire:click.prevent="delete('{{$video->id}}')" class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $videos->links()}}
                </div>
            @endforeach
        </div>
    </div>
</div>
