<?php

namespace App\Jobs;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $destination = '/' .$this->video->uid . '/' . $this->video->uid . '.m3u8';

        $low = (new X264)->setKiloBitrate(500);
        $high = (new X264)->setKiloBitrate(1000);

        FFMpeg::fromDisk('videos-temp')
        ->open($this->video->path)
        ->exportForHLS()
        ->toDisk('videos')

        ->addFormat($low, function($filters) {
            $filters->resize(640, 480);
        })
        ->addFormat($high, function($filters) {
            $filters->resize(1280, 720);
        })

        ->onProgress(function($progress) {
            $this->video->update([
                'processing_percentage' => $progress
            ]);
        })
        ->save($destination);

        $this->video->update([
            'processed' => true,
            'processed_file' => $this->video->uid . '.m3u8'
        ]);

        //delete temp videos
        $result = Storage::disk('videos-temp')->delete($this->video->path);
        Log::info($this->video->path . ' video was deleted from the temp folder');
    }
}
