<?php
/**
 * Controller to work with home page data.
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StaticModels\Announcement;
use App\Models\Tickets;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Return the home page.
     * 
     * @return view
     */
    public function getHome(){
        $announcements = Cache::remember('announcement', 604800, function () {
            return Announcement::all();
        });
        $statistics = Cache::remember('statistics', 86400, function () {
            return Tickets::getStatistics();
        });

        return view('pages.home', [
            'announcements' => $announcements,
            'statistics' => $statistics
        ]);
    }
}
