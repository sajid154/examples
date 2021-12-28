<?php

namespace App\Observers;

use App\Post;

class PostObserver
{
    /**
     * Handle the post "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function saving(Post $post)
    {
        // dd("Asa");
        $post->slug = str_slug($post->title);
    }

        public function created(Post $user)
    {
        // return redirect('/login');

         return redirect()
                            ->route("capture-screenshot",1)
                           ->send();
    }


}
