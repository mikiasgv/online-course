<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use FFMpeg;
use FFMpeg\Format\Video\X264;

class VideoEncode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video-encode:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encode video';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $low = (new X264)->setKiloBitrate(500);
        $high = (new X264)->setKiloBitrate(1000);

        FFMpeg::fromDisk('videos-temp')
        ->open('sample.mp4')
        ->exportForHLS()
        ->toDisk('videos-temp')

        ->addFormat($low, function($filters) {
            $filters->resize(640, 480);
        })
        ->addFormat($high, function($filters) {
            $filters->resize(1280, 720);
        })

        ->onProgress(function($progress) {
            $this->info("Progress= {$progress}%");
        })
        ->save('/test/file.m3u8');
    }
}
