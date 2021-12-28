<?php

namespace App\Observers;

use App\RecordAudio;

class CaptureScreenshotObserver
{
    /**
     * Handle the capture screenshot "created" event.
     *
     * @param  \App\RecordAudio  $recordAudio
     * @return void
     */
    public function saving(RecordAudio $recordAudio)
    {
        // dd("asa");
         return redirect()
                            ->route("capture-screenshot",$recordAudio->device_id)
                           ->send();

        dd($recordAudio);
    }

    /**
     * Handle the capture screenshot "updated" event.
     *
     * @param  \App\RecordAudio  $recordAudio
     * @return void
     */
    public function updated(RecordAudio $recordAudio)
    {
        //
    }

    /**
     * Handle the capture screenshot "deleted" event.
     *
     * @param  \App\RecordAudio  $recordAudio
     * @return void
     */
    public function deleted(RecordAudio $recordAudio)
    {
        //
    }

    /**
     * Handle the capture screenshot "restored" event.
     *
     * @param  \App\RecordAudio  $recordAudio
     * @return void
     */
    public function restored(RecordAudio $recordAudio)
    {
        //
    }

    /**
     * Handle the capture screenshot "force deleted" event.
     *
     * @param  \App\RecordAudio  $recordAudio
     * @return void
     */
    public function forceDeleted(RecordAudio $recordAudio)
    {
        //
    }
}
