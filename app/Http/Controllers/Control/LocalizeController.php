<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class LocalizeController extends Controller
{
    /**
     * Renders the langs list view.
     *
     * @return view
     */
    public function getLangs(){
        $lang = request()->lang;
        $page = request()->input('page') ? request()->input('page') : 1;
        $per_page = 20;
        $offset = $per_page * $page - $per_page;

        $paginator = [
            'page' => $page,
            'per_page' => $per_page
        ];

        $translates = null;
        $locales = config('app.locales');

        $translates = json_decode(
            file_get_contents(
                resource_path() . '/lang/' . $lang . '.json'
            ),
            true
        );
        asort($translates);
        $paginator['total_item_count'] = count($translates);
        $paginator['total_pages_count'] = ceil(count($translates)/$per_page);

        $translates = array_slice($translates, $offset, $per_page);

        $paginator['page_item_count'] = count($translates);

        return view('pages.control.localize', [
            'locales' => $locales,
            'translates' => $translates,
            'paginator' => $paginator
        ]);
    }

    /**
     * Processes the post data from translate page.
     *
     * @return redirect
     */
    public function getLangsPost(){

        $lang = request()->lang;
        $original = request()->input('original');
        $translate = request()->input('translate');
        $translates = json_decode(
            file_get_contents(
                resource_path() . '/lang/' . $lang . '.json'
            ),
            true
        );

        $translates[$original] = $translate;
        $translates_json = json_encode($translates, JSON_UNESCAPED_UNICODE);

        file_put_contents(resource_path() . '/lang/' . $lang . '.json', $translates_json);

        return redirect()->back();
    }
}
