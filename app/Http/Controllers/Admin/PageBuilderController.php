<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Repositories\Admin\PageBuilderRepositoryEloquent as PageBuilder;
use App\Repositories\Admin\ConfigRepositoryEloquent as Config;


class PageBuilderController extends Controller 
{
    protected $pageBuilderRepo;
    protected $configRepo;

    function __construct(PageBuilder $pageBuilderRepo, Config $configRepo)
    {
        $this->pageBuilderRepo = $pageBuilderRepo;
        $this->configRepo = $configRepo;
    }

    public function index () 
    {
        $data['module'] = 'page';
        // $data['pageBuilder'] = $this->pageBuilderRepo->all();
        $config = $this->configRepo->find(1);
        $data['is_dark_mode'] = ($config['is_dark_mode'] == 1) ? true : false;
        $data['tvpage'] = true;
        return view('admin.pagebuilder.index', $data);
    }

    public function store (Request $request) 
    {
        $output = [
            'response' => 400,
            'message' => ''
        ];
        if ($this->pageBuilderRepo->findByField('title', $request->title)) {
            $output['message'] = "Page title already exists";
        } else if ($this->pageBuilderRepo->findByField('url', $request->url)) {
            $output['message'] = "Page url already exists";
        } else {
            $output['response'] = 200;
            $output['message'] = "Page successfully created";
            $this->pageBuilderRepo->create($request->all());
        }
        return $output;
    }

    public function edit ($hashedId) 
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        return $data['pageBuilder'] = $this->pageBuilderRepo->find($id);
    }

    public function update (Request $request, $hashedId) 
    {
        $output = [
            'response' => 400,
            'message' => ''
        ];

        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($request->hashedId);
        
        if (DB::table('page_builder')->where('id', '!=', $id)->where('title', $request->title)->exists()) {
            $output['message'] = "Page title already exists";
        } else if (DB::table('page_builder')->where('id', '!=', $id)->where('url', $request->url)->exists()) {
            $output['message'] = "Page url already exists";
        } else {
            $output['response'] = 200;
            $output['message'] = "Page successfully updated";
            $makeRequest = [
                'title' => $request->title
            ];
            if ($id != 1 || $id != 7) {
                $makeRequest['url'] = $request->url;
            }
            $this->pageBuilderRepo->update($makeRequest, $id);
        }
        return $output;
    }

    public function build ($hashedId) 
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data['page_id'] = $id;
        $data['reload_page_api'] = url()->current()."/getcontent";
        return view('admin.pagebuilder.build', $data);
    }

    public function buildPage (Request $request, $id) 
    {
        $makeRequest = [
            'html' => $request->html,
            'css' => $request->css
        ];
         $this->pageBuilderRepo->update($makeRequest, $id);
        return $request->all();
        return true;
    }

    public function getContent ($hashedId) 
    {
        // return $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        // return $data['pageBuilder'] = $this->pageBuilderRepo->find($id);
        
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $pageBuilder = $this->pageBuilderRepo->find($id);
        // return $data['pageBuilder'] = $this->pageBuilderRepo->find($id);
        if ($pageBuilder['html'] == '') {
            $pageBuilder['css'] = '*{box-sizing:border-box}body{margin:0}.clearfix{clear:both}.header-banner{padding-top:35px;padding-bottom:100px;color:#fff;font-family:Helvetica,serif;font-weight:100;background-image:url(//grapesjs.com/img/bg-gr-v.png),url(//grapesjs.com/img/work-desk.jpg);background-attachment:scroll,scroll;background-position:left top,center center;background-repeat:repeat-y,no-repeat;background-size:contain,cover}.container-width{width:90%;max-width:1150px;margin:0 auto}.logo-container{float:left;width:50%}.logo{background-color:#fff;border-radius:5px;width:130px;padding:10px;min-height:30px;text-align:center;line-height:30px;color:#4d114f;font-size:23px}.menu{float:right;width:50%}.menu-item{float:right;font-size:15px;color:#eee;width:130px;padding:10px;min-height:50px;text-align:center;line-height:30px;font-weight:400}.lead-title{margin:150px 0 30px 0;font-size:40px}.sub-lead-title{max-width:650px;line-height:30px;margin-bottom:30px;color:#c6c6c6}.lead-btn{margin-top:15px;padding:10px;width:190px;min-height:30px;font-size:20px;text-align:center;letter-spacing:3px;line-height:30px;background-color:#d983a6;border-radius:5px;transition:all .5s ease;cursor:pointer}.lead-btn:hover{background-color:#fff;color:#4c114e}.lead-btn:active{background-color:#4d114f;color:#fff}.flex-sect{background-color:#fafafa;padding:100px 0;font-family:Helvetica,serif}.flex-title{margin-bottom:15px;font-size:2em;text-align:center;font-weight:700;color:#555;padding:5px}.flex-desc{margin-bottom:55px;font-size:1em;color:rgba(0,0,0,.5);text-align:center;padding:5px}.cards{padding:20px 0;display:flex;justify-content:space-around;flex-flow:wrap}.card{background-color:#fff;height:300px;width:300px;margin-bottom:30px;box-shadow:0 1px 2px 0 rgba(0,0,0,.2);border-radius:2px;transition:all .5s ease;font-weight:100;overflow:hidden}.card:hover{margin-top:-5px;box-shadow:0 20px 30px 0 rgba(0,0,0,.2)}.card-header{height:155px;background-image:url(//placehold.it/350x250/78c5d6/fff/image1.jpg);background-size:cover;background-position:center center}.card-header.ch2{background-image:url(//placehold.it/350x250/459ba8/fff/image2.jpg)}.card-header.ch3{background-image:url(//placehold.it/350x250/79c267/fff/image3.jpg)}.card-header.ch4{background-image:url(//placehold.it/350x250/c5d647/fff/image4.jpg)}.card-header.ch5{background-image:url(//placehold.it/350x250/f28c33/fff/image5.jpg)}.card-header.ch6{background-image:url(//placehold.it/350x250/e868a2/fff/image6.jpg)}.card-body{padding:15px 15px 5px 15px;color:#555}.card-title{font-size:1.4em;margin-bottom:5px}.card-sub-title{color:#b3b3b3;font-size:1em;margin-bottom:15px}.card-desc{font-size:.85rem;line-height:17px}.am-sect{padding-top:100px;padding-bottom:100px;font-family:Helvetica,serif}.img-phone{float:left}.am-container{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-around}.am-content{float:left;padding:7px;width:490px;color:#444;font-weight:100;margin-top:50px}.am-pre{padding:7px;color:#b1b1b1;font-size:15px}.am-title{padding:7px;font-size:25px;font-weight:400}.am-desc{padding:7px;font-size:17px;line-height:25px}.am-post{padding:7px;line-height:25px;font-size:13px}.blk-sect{padding-top:100px;padding-bottom:100px;background-color:#222;font-family:Helvetica,serif}.blk-title{color:#fff;font-size:25px;text-align:center;margin-bottom:15px}.blk-desc{color:#b1b1b1;font-size:15px;text-align:center;max-width:700px;margin:0 auto;font-weight:100}.price-cards{margin-top:70px;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-around}.price-card-cont{width:300px;padding:7px;float:left}.price-card{margin:0 auto;min-height:350px;background-color:#d983a6;border-radius:5px;font-weight:100;color:#fff;width:90%}.pc-title{font-weight:100;letter-spacing:3px;text-align:center;font-size:25px;background-color:rgba(0,0,0,.1);padding:20px}.pc-desc{padding:75px 0;text-align:center}.pc-feature{color:rgba(255,255,255,.5);background-color:rgba(0,0,0,.1);letter-spacing:2px;font-size:15px;padding:10px 20px}.pc-feature:nth-of-type(2n){background-color:transparent}.pc-amount{background-color:rgba(0,0,0,.1);font-size:35px;text-align:center;padding:35px 0}.pc-regular{background-color:#da78a0}.pc-enterprise{background-color:#d66a96}.footer-under{background-color:#312833;padding-bottom:100px;padding-top:100px;min-height:500px;color:#eee;position:relative;font-weight:100;font-family:Helvetica,serif}.copyright{background-color:rgba(0,0,0,.15);color:rgba(238,238,238,.5);bottom:0;padding:1em 0;position:absolute;width:100%;font-size:.75em}.made-with{float:left;width:50%;padding:5px 0}.foot-social-btns{display:none;float:right;width:50%;text-align:right;padding:5px 0}.footer-container{display:flex;flex-wrap:wrap;align-items:stretch;justify-content:space-around}.foot-list{float:left;width:200px}.foot-list-title{font-weight:400;margin-bottom:10px;padding:.5em 0}.foot-list-item{color:rgba(238,238,238,.8);font-size:.8em;padding:.5em 0}.foot-list-item:hover{color:#eee}.foot-form-cont{width:300px;float:right}.foot-form-title{color:rgba(255,255,255,.75);font-weight:400;margin-bottom:10px;padding:.5em 0;text-align:right;font-size:2em}.foot-form-desc{font-size:.8em;color:rgba(255,255,255,.55);line-height:20px;text-align:right;margin-bottom:15px}.sub-input{width:100%;margin-bottom:15px;padding:7px 10px;border-radius:2px;color:#fff;background-color:#554c57;border:none}.sub-btn{width:100%;margin:15px 0;background-color:#785580;border:none;color:#fff;border-radius:2px;padding:7px 10px;font-size:1em;cursor:pointer}.sub-btn:hover{background-color:#91699a}.sub-btn:active{background-color:#573f5c}.bdg-sect{padding-top:100px;padding-bottom:100px;font-family:Helvetica,serif;background-color:#fafafa}.bdg-title{text-align:center;font-size:2em;margin-bottom:55px;color:#555}.badges{padding:20px;display:flex;justify-content:space-around;align-items:flex-start;flex-wrap:wrap}.badge{width:290px;font-family:Helvetica,serif;background-color:#fff;margin-bottom:30px;box-shadow:0 2px 2px 0 rgba(0,0,0,.2);border-radius:3px;font-weight:100;overflow:hidden;text-align:center}.badge-header{height:115px;background-image:url(//grapesjs.com/img/bg-gr-v.png),url(//grapesjs.com/img/work-desk.jpg);background-position:left top,center center;background-attachment:scroll,fixed;overflow:hidden}.badge-name{font-size:1.4em;margin-bottom:5px}.badge-role{color:#777;font-size:1em;margin-bottom:25px}.badge-desc{font-size:.85rem;line-height:20px}.badge-avatar{width:100px;height:100px;border-radius:100%;border:5px solid #fff;box-shadow:0 1px 1px 0 rgba(0,0,0,.2);margin-top:-75px;position:relative}.badge-body{margin:35px 10px}.badge-foot{color:#fff;background-color:#a290a5;padding-top:13px;padding-bottom:13px;display:flex;justify-content:center}.badge-link{height:35px;width:35px;line-height:35px;font-weight:700;background-color:#fff;color:#a290a5;display:block;border-radius:100%;margin:0 10px}@media (max-width:768px){.foot-form-cont{width:400px}.foot-form-title{width:autopx}}@media (max-width:480px){.foot-lists{display:none}}';
            $pageBuilder['html'] = '<header class="header-banner"> <div class="container-width" id="igvq"> <div class="logo-container"> <div class="logo">GrapesJS </div></div><nav class="menu"> <div class="menu-item">BUILDER </div><div class="menu-item">TEMPLATE </div><div class="menu-item">WEB </div></nav> <div class="clearfix"> </div><div class="lead-title">Build your templates without coding </div><div class="sub-lead-title">All text blocks could be edited easily with double clicking on it. You can create new text blocks with the command from the left panel </div><div class="lead-btn">Hover me </div></div></header><section class="flex-sect"> <div class="container-width"> <div class="flex-title">Flex is the new black </div><div class="flex-desc">With flexbox system you&#039;re able to build complex layouts easily and with free responsivity </div><div class="cards"> <div class="card"> <div class="card-header"> </div><div class="card-body"> <div class="card-title">Title one </div><div class="card-sub-title">Subtitle one </div><div class="card-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </div></div></div><div class="card"> <div class="card-header ch2"> </div><div class="card-body"> <div class="card-title">Title two </div><div class="card-sub-title">Subtitle two </div><div class="card-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </div></div></div><div class="card"> <div class="card-header ch3"> </div><div class="card-body"> <div class="card-title">Title three </div><div class="card-sub-title">Subtitle three </div><div class="card-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </div></div></div><div class="card"> <div class="card-header ch4"> </div><div class="card-body"> <div class="card-title">Title four </div><div class="card-sub-title">Subtitle four </div><div class="card-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </div></div></div><div class="card"> <div class="card-header ch5"> </div><div class="card-body"> <div class="card-title">Title five </div><div class="card-sub-title">Subtitle five </div><div class="card-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </div></div></div><div class="card"> <div class="card-header ch6"> </div><div class="card-body"> <div class="card-title">Title six </div><div class="card-sub-title">Subtitle six </div><div class="card-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore </div></div></div></div></div></section><section class="am-sect"> <div class="container-width"> <div class="am-container"> <img onmousedown="return false" src="./img/phone-app.png" class="img-phone"/> <div class="am-content"> <div class="am-pre">ASSET MANAGER </div><div class="am-title">Manage your images with Asset Manager </div><div class="am-desc">You can create image blocks with the command from the left panel and edit them with double click </div><div class="am-post">Image uploading is not allowed in this demo </div></div></div></div></section><section class="blk-sect"> <div class="container-width"> <div class="blk-title">Blocks </div><div class="blk-desc">Each element in HTML page could be seen as a block. On the left panel you could find different kind of blocks that you can create, move and style </div><div class="price-cards"> <div class="price-card-cont"> <div class="price-card"> <div class="pc-title">Starter </div><div class="pc-desc">Some random list </div><div class="pc-feature odd-feat">+ Starter feature 1 </div><div class="pc-feature">+ Starter feature 2 </div><div class="pc-feature odd-feat">+ Starter feature 3 </div><div class="pc-feature">+ Starter feature 4 </div><div class="pc-amount odd-feat">$ 9,90/mo </div></div></div><div class="price-card-cont"> <div class="price-card pc-regular"> <div class="pc-title">Regular </div><div class="pc-desc">Some random list </div><div class="pc-feature odd-feat">+ Regular feature 1 </div><div class="pc-feature">+ Regular feature 2 </div><div class="pc-feature odd-feat">+ Regular feature 3 </div><div class="pc-feature">+ Regular feature 4 </div><div class="pc-amount odd-feat">$ 19,90/mo </div></div></div><div class="price-card-cont"> <div class="price-card pc-enterprise"> <div class="pc-title">Enterprise </div><div class="pc-desc">Some random list </div><div class="pc-feature odd-feat">+ Enterprise feature 1 </div><div class="pc-feature">+ Enterprise feature 2 </div><div class="pc-feature odd-feat">+ Enterprise feature 3 </div><div class="pc-feature">+ Enterprise feature 4 </div><div class="pc-amount odd-feat">$ 29,90/mo </div></div></div></div></div></section><section class="bdg-sect"> <div class="container-width"> <h1 class="bdg-title">The team </h1> <div class="badges"> <div class="badge"> <div class="badge-header"> </div><img src="img/team1.jpg" class="badge-avatar"/> <div class="badge-body"> <div class="badge-name">Adam Smith </div><div class="badge-role">CEO </div><div class="badge-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ipsum dolor sit </div></div><div class="badge-foot"> <span class="badge-link">f</span> <span class="badge-link">t</span> <span class="badge-link">ln</span> </div></div><div class="badge"> <div class="badge-header"> </div><img src="img/team2.jpg" class="badge-avatar"/> <div class="badge-body"> <div class="badge-name">John Black </div><div class="badge-role">Software Engineer </div><div class="badge-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ipsum dolor sit </div></div><div class="badge-foot"> <span class="badge-link">f</span> <span class="badge-link">t</span> <span class="badge-link">ln</span> </div></div><div class="badge"> <div class="badge-header"> </div><img src="img/team3.jpg" class="badge-avatar"/> <div class="badge-body"> <div class="badge-name">Jessica White </div><div class="badge-role">Web Designer </div><div class="badge-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ipsum dolor sit </div></div><div class="badge-foot"> <span class="badge-link">f</span> <span class="badge-link">t</span> <span class="badge-link">ln</span> </div></div></div></div></section><footer class="footer-under"> <div class="container-width"> <div class="footer-container"> <div class="foot-lists"> <div class="foot-list"> <div class="foot-list-title">About us </div><div class="foot-list-item">Contact </div><div class="foot-list-item">Events </div><div class="foot-list-item">Company </div><div class="foot-list-item">Jobs </div><div class="foot-list-item">Blog </div></div><div class="foot-list"> <div class="foot-list-title">Services </div><div class="foot-list-item">Education </div><div class="foot-list-item">Partner </div><div class="foot-list-item">Community </div><div class="foot-list-item">Forum </div><div class="foot-list-item">Download </div><div class="foot-list-item">Upgrade </div></div><div class="clearfix"> </div></div><div class="form-sub"> <div class="foot-form-cont"> <div class="foot-form-title">Subscribe </div><div class="foot-form-desc">Subscribe to our newsletter to receive exclusive offers and the latest news </div><input name="name" placeholder="Name" class="sub-input"/> <input name="email" placeholder="Email" class="sub-input"/> <button type="button" class="sub-btn">Submit</button> </div></div></div></div><div class="copyright"> <div class="container-width"> <div class="made-with"> made with GrapesJS </div><div class="foot-social-btns">facebook twitter linkedin mail </div><div class="clearfix"> </div></div></div></footer>';
        }
        return $pageBuilder;
    }


    /**
     * Process the current GET or POST request and redirect or render the requested page.
     *
     * @param $route
     * @param $action
     */
    public function handleRequest (Request $request)
    {
        if (!isset($_SESSION['phpb_logged_in'])) 
        {
            return redirect('/');
        }

        if (is_null($request->route)) {
            return $this->renderOverview();
        }
        
        if ($request->route === 'settings') {
            if ($request->action === 'renderBlockThumbs') {
                return $this->renderBlockThumbs();
            }
            if ($request->action === 'update') {
                return $this->handleUpdateSettings();
            }
        }

        if ($request->route === 'page_settings') {
            if ($request->action === 'create') {
                return $this->handleCreate($request);
            }
            
            $pageId = $request->page ?? null;
            $pageRepository = new PageRepository;
            $page = $pageRepository->findWithId($pageId);
            if (! ($page instanceof PageContract)) {
                phpb_redirect(phpb_url('website_manager'));
            }

            if ($request->action === 'edit') {
                return $this->handleEdit($page);
                // return $this->handleEdit($page);
            } else if ($request->action === 'destroy') {
                return $this->handleDestroy($page);
            }
        }
        // return $request->all();
        // return $request->all();
        // return $this->handleSubmit($request);
        if ($request->action == "edit") {
            $pageRepository = new PageRepository;
            $page = $pageRepository->findWithId($request->pageId);
            // return $pageId = $request->page ?? null;
            // return $request->all();
            return $this->handleEdit($page);
        } else {
            return $this->handleSubmit($request);
        }

    }

    /**
     * Render the website manager overview page.
     */
    public function renderOverview  () 
    {
        $pageRepository = new PageRepository;
        $pages = $pageRepository->getAll();
        $data['pages'] = $pages;
        $data['pagesTabActive'] = ! isset($_GET['tab']) || $_GET['tab'] === 'pages' ? 'active' : '';
        $data['menusTabActive'] = isset($_GET['tab']) && $_GET['tab'] === 'menus' ? 'active' : '';
        $data['settingsTabActive'] = isset($_GET['tab']) && $_GET['tab'] === 'settings' ? 'active' : '';
        return view('admin.pagebuilder.overview', $data);
    }

    /**
     * Handle requests for creating a new page.
     */
    public function handleCreate(Request $request)
    {
        // return $this->renderPageSettings('create');
        return $this->renderPageSettings();
    }

    public function handleSubmit(Request $request) 
    {
        
        // return $request->layout;
        if ($request->layout != null) {
            // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pageRepository = new PageRepository;
            $page = $pageRepository->create($request->all());
            if ($page) {
                phpb_redirect(phpb_url('website_manager'), [
                    'message-type' => 'success',
                    'message' => phpb_trans('website-manager.page-created')
                ]);
            }
        }
    }


    /**
     * Handle requests for editing the given page.
     *
     * @param PageContract $page
     */
    // public function handleEdit(PageContract $page)
    public function handleEdit(PageContract $page)
    {
        if (isset($_GET['pageId']) != "") 
        {
            $pageRepository = new PageRepository;
            $success = $pageRepository->update($page, $_GET);
            if ($success) {
                phpb_redirect(phpb_url('website_manager'), [
                    'message-type' => 'success',
                    'message' => phpb_trans('website-manager.page-updated')
                ]);
            }
            return "qwe";
        }

        return $this->renderPageSettings($page);
        // $this->renderPageSettings($page);
    }

    /**
     * Handle requests to destroy the given page.
     *
     * @param PageContract $page
     */
    public function handleDestroy(PageContract $page)
    {
        $pageRepository = new PageRepository;
        $pageRepository->destroy($page->getId());
        phpb_redirect(phpb_url('website_manager'), [
            'message-type' => 'success',
            'message' => phpb_trans('website-manager.page-deleted')
        ]);
    }

    /**
     * Render the website manager page settings (add/edit page form).
     *
     * @param PageContract $page
     */
    public function renderPageSettings(PageContract $page = null)
    {
        //     return var_dump($page);
        // return isset($page) ? $page->getId() : null;
        $data['theme'] = phpb_instance('theme', [phpb_config('theme'), phpb_config('theme.active_theme')]);
        
        // echo phpb_trans('website-manager.layout');
        // echo '<pre>';
        // print_r($page);
        // echo '</pre>';
        // exit;
        $data['route'] = $_GET['route'];
        $data['action'] = isset($page) ? 'edit' : 'create';
        $data['page'] = isset($page) ? $page : null;
        $data['pageUrlParam'] = (isset($page)) ?  $pageUrlParam = '&page=' . phpb_e($page->getId()) : null;
        $data['pageTranslations'] = (isset($page)) ?  $page->getTranslations() : [];
        // $data['value'] = 'Master';
        $data['value'] = phpb_field_value('layout', $page);
        // return $data['value'] = phpb_field_value('name', $page);
        
        return view('admin.pagebuilder.page-settings', $data);
    }


    /**
     * Render a thumbnail for each theme block.
     */
    public function renderBlockThumbs()
    {
        $viewFile = 'block-thumbs';
        require __DIR__ . '/resources/layouts/master.php';
    }


    /**
     * Handle requests for updating the website settings.
     */
    public function handleUpdateSettings()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $settingRepository = new SettingRepository;
            $success = $settingRepository->updateSettings($_POST);
            if ($success) {
                phpb_redirect(phpb_url('website_manager', ['tab' => 'settings']), [
                    'message-type' => 'success',
                    'message' => phpb_trans('website-manager.settings-updated')
                ]);
            }
        }
    }

    public function page($pageId = null) 
    { 
        $pageRepository = new \PHPageBuilder\Repositories\PageRepository; 
        $page = $pageRepository->findWithId($pageId); 
        return $page; 
    }

    public function viewPage($pageId)
    {
        return $pageId;
        $theme = new Theme(config('pagebuilder.theme'), config('pagebuilder.theme.active_theme'));
        $page = (new PageRepository)->findWithId($pageId);
        $pageRenderer = new PageRenderer($theme, $page);
        $html = $pageRenderer->render();
        return $html;
    }

    public function grapeJsGetTemplate (Request $request, $id) 
    {
        $data['pageTemplate'] = $this->pageTemplateRepo->find($id);
        return $request->all();
    }

    public function grapeJsSaveTemplate (Request $request) 
    {
        $this->pageTemplateRepo->create($request->all());
        return $request->all();
    }
}