<?php
namespace App\Http\viewComposers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer{
    public function compose(View $view){
        $interactiveUsers=Cache::remember('interactiveUsers',now()->addSeconds(100),function(){
            return User::interactiveUsers()->take(5)->get();
        });

        $view->with([
            'interactiveUsers'=>$interactiveUsers
        ]);

    }
}