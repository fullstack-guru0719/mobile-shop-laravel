<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Admin\ConfigRepositoryEloquent as Config;
use App\Repositories\Admin\PageMetaTagRepositoryEloquent as PageMetaTag;
use App\Repositories\Admin\PageBuilderRepositoryEloquent as PageBuilder;
use App\Repositories\Customer\StateRepositoryEloquent as State;
use App\Repositories\Admin\MenuRepositoryEloquent as Menu;
use App\Models\TableList as Tablelist;

class PageViewerController extends Controller
{
    protected $configRepo;
    protected $pageMetaTagRepo;
    protected $pageBuilderRepo;
    protected $stateRepo;
    protected $menuRepo;
    protected $tablelist;

    public function __construct(Config $configRepo, PageMetaTag $pageMetaTagRepo, PageBuilder $pageBuilderRepo, Menu $menuRepo, Tablelist $tablelist)
    {
        $this->configRepo = $configRepo;
        $this->pageMetaTagRepo = $pageMetaTagRepo;
        $this->pageBuilderRepo = $pageBuilderRepo;
        $this->menuRepo = $menuRepo;
        $this->tablelist = $tablelist;
    }

    public function Config()
    {
        $data['config'] = $this->configRepo->find(1);
        $data['tvsettings'] = true;
        $data['stateList'] = $this->stateRepo->selectlist('name', 'abbr');
        $data['module'] = 'config';
        $data['is_dark_mode'] = ($data['config']['is_dark_mode'] == 1) ? true : false;
        return view('admin.settings.config.index', $data);
    }

    public function Customers()
    {
        $data['module'] = 'customer';
        $config = $this->configRepo->find(1);
        $data['is_dark_mode'] = ($config['is_dark_mode'] == 1) ? true : false;
        return view('admin.customers.index', $data);
    }

    public function MetaTags($hashedId)
    {
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data['page'] = $this->pageBuilderRepo->find($id);
        $data['config'] = $this->configRepo->find(1);
        $data['tvpage'] = true;
        $data['tags'] = $this->tablelist->array_meta_tags;
        $data['pageBuilder'] = $this->pageBuilderRepo->all();
        $data['module'] = 'page';
        $data['hashedId'] = $hashedId;
        $data['is_dark_mode'] = ($data['config']['is_dark_mode'] == 1) ? true : false;
        return view('admin.pagebuilder.tag', $data);
    }

    public function Status()
    {
        $data['module'] = 'status';
        $data['tvsettings'] = true;
        $data['config'] = $this->configRepo->find(1);
        $data['is_dark_mode'] = ($data['config']['is_dark_mode'] == 1) ? true : false;
        $data['badges'] = $this->tablelist->badge;
        return view('admin.settings.status.index', $data);
    }

    public function Categories()
    {
        $data['module'] = 'category';
        $data['tvsettings'] = true;
        $data['config'] = $this->configRepo->find(1);
        $data['is_dark_mode'] = ($data['config']['is_dark_mode'] == 1) ? true : false;
        return view('admin.settings.categories.index', $data);
    }

    public function Menus()
    {
        $data['menus'] = $this->menuRepo->all();
        $data['module'] = 'menu';
        $data['tvsettings'] = true;
        $config = $this->configRepo->find(1);
        $data['is_dark_mode'] = ($config['is_dark_mode'] == 1) ? true : false;
        return view('admin.settings.menus.index', $data);
    }

    public function Users()
    {
        $data['module'] = 'user';
        $data['tvsettings'] = true;
        $config = $this->configRepo->find(1);
        $data['is_dark_mode'] = ($config['is_dark_mode'] == 1) ? true : false;
        return view('admin.settings.users.index', $data);
    }

    public function CreateUser()
    {
        $data['module'] = 'user';
        $data['tvsettings'] = true;
        $config = $this->configRepo->find(1);
        $data['is_dark_mode'] = ($config['is_dark_mode'] == 1) ? true : false;
        return view('admin.settings.users.create', $data);
    }

    public function EditUser($hashedId)
    {
        $data['module'] = 'user';
        $data['tvsettings'] = true;
        $id = app('App\Http\Controllers\GlobalFunctionController')->decodeHashid($hashedId);
        $data['user'] = $this->userRepo->find($id);
        $config = $this->configRepo->find(1);
        $data['is_dark_mode'] = ($config['is_dark_mode'] == 1) ? true : false;
        return view('admin.settings.users.edit', $data);
    }

    public function ProductMaps()
    {
        return 'asd';
        $data['storageList'] = ['' => '--', '32GB', '64GB', '128GB', '256GB', '512GB'];
        $data['networkList'] = ['' => '--', 'AT&T' => 'AT&T', 'Sprint' => 'Sprint', 'T-Mobile' => 'T-Mobile', 'Verizon' => 'Verizon', 'Unlocked' => 'Unlocked'];
        $data['config'] = $this->configRepo->find(1);
        $data['module'] = 'product';
        $data['is_dark_mode'] = ($data['config']['is_dark_mode'] == 1) ? true : false;
        $data['tvproducts'] = true;
        return view('admin.products.index', $data);
    }


    public function Brands()
    {
        $data['module'] = 'brand';
        $data['tvsettings'] = true;
        $data['types'] = ['' => 'Choose Device', 'Mobile' => 'Mobile Device', 'Other' => 'Other Devices', 'Gaming' => 'Gaming Devices'];
        $data['featureList'] = ['' => 'No', 1 => 'Yes at Row 1', 2 => 'Yes at Row 2', 3 => 'Yes at Row 3', 4 => 'Yes at Row 4'];
        $data['config'] = $this->configRepo->find(1);
        $data['is_dark_mode'] = ($data['config']['is_dark_mode'] == 1) ? true : false;
        return view('admin.settings.brands.index', $data);
    }

    public function EmailTemplates()
    {
        $data['module'] = 'email';
        $data['tvtemplates'] = true;
        $data['config'] = $this->configRepo->find(1);
        $data['is_dark_mode'] = ($data['config']['is_dark_mode'] == 1) ? true : false;
        return view('admin.templates.email.index', $data);
    }

    public function SmsTemplates()
    {
        $data['module'] = 'sms';
        $data['tvtemplates'] = true;
        $data['config'] = $this->configRepo->find(1);
        $data['placeholder_customer_list'] = $this->tablelist->placeholder_customer_list;
        $data['placeholder_order_list'] = $this->tablelist->placeholder_order_list;
        $data['is_dark_mode'] = ($data['config']['is_dark_mode'] == 1) ? true : false;
        return view('admin.templates.sms.index', $data);
    }
}
