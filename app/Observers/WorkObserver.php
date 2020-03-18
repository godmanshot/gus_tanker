<?php

namespace App\Observers;

use App\Work;

class WorkObserver
{
    /**
     * Handle the work "created" event.
     *
     * @param  \App\Work  $work
     * @return void
     */
    public function created(Work $work)
    {
        /**
         * Прикрепить новую работу к СТО прикрипленной к текущему пользователю
         */
        $station = station();
        
        $station->works()->attach($work->id);
    }

    /**
     * Handle the work "updated" event.
     *
     * @param  \App\Work  $work
     * @return void
     */
    public function updated(Work $work)
    {
        //
    }

    /**
     * Handle the work "deleted" event.
     *
     * @param  \App\Work  $work
     * @return void
     */
    public function deleted(Work $work)
    {
        //
    }

    /**
     * Handle the work "restored" event.
     *
     * @param  \App\Work  $work
     * @return void
     */
    public function restored(Work $work)
    {
        //
    }

    /**
     * Handle the work "force deleted" event.
     *
     * @param  \App\Work  $work
     * @return void
     */
    public function forceDeleted(Work $work)
    {
        //
    }
}
