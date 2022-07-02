<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\PageBuilder;
use PHPageBuilder\PHPageBuilder;
use PHPageBuilder\Theme;
use PHPageBuilder\Modules\GrapesJS\PageRenderer;
use PHPageBuilder\Repositories\PageRepository;
use PHPageBuilder\Repositories\PageTranslationRepository;


class WebsiteController extends Controller 
{
    public function uri()
    {
        $currentUrl = phpb_current_relative_url();
        $urlTitle = substr($currentUrl, 1);
        $parameters = array();
        array_push($parameters, $urlTitle);
        
        $page = (new PageTranslationRepository)->findWhere("route", $urlTitle);
        // return $page;
        // return count($page);
        if ($page == null) {
            return "invalid page";
            // return false;
        }
        // return phpb_e(phpb_full_url(phpb_current_relative_url()));
        $pageId = $page[0]->page_id;
        
        $theme = new Theme(config('pagebuilder.theme'), config('pagebuilder.theme.active_theme'));
        $page = (new PageRepository)->findWithId($pageId);
        $pageRenderer = new PageRenderer($theme, $page);
        $html = $pageRenderer->render();
        return $html;



        $pageBuilder = app()->make('phpPageBuilder');
        $pageBuilder->handlePublicRequest();
        // return $pageBuilder;
        // return phpb_current_relative_url();
        return phpb_e(phpb_full_url(phpb_current_relative_url()));
    }
    // public function uri()
    // {
    //     // return "asd";
    //     $pageBuilder = app()->make('phpPageBuilder');
    //     $pageBuilder->handlePublicRequest();
    //     return "ok";
    //     return $pageBuilder;
    // }
}

