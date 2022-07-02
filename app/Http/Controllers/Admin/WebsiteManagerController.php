<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PHPageBuilder\Contracts\PageContract;
use PHPageBuilder\Contracts\WebsiteManagerContract;
use PHPageBuilder\Repositories\PageRepository;
use PHPageBuilder\Repositories\SettingRepository;

// implements WebsiteManagerContract

class WebsiteManagerController extends Controller
{
    /**
     * Process the current GET or POST request and redirect or render the requested page.
     *
     * @param $route
     * @param $action
     */
    public function handleRequest($route, $action)
    {
        if (is_null($route)) {
            $this->renderOverview();
            exit();
        }

        if ($route === 'settings') {
            if ($action === 'renderBlockThumbs') {
                $this->renderBlockThumbs();
                exit();
            }
            if ($action === 'update') {
                $this->handleUpdateSettings();
                exit();
            }
        }

        if ($route === 'page_settings') {
            if ($action === 'create') {
                $this->handleCreate();
                exit();
            }

            $pageId = $_GET['page'] ?? null;
            $pageRepository = new PageRepository;
            $page = $pageRepository->findWithId($pageId);
            if (! ($page instanceof PageContract)) {
                phpb_redirect(phpb_url('website_manager'));
            }

            if ($action === 'edit') {
                $this->handleEdit($page);
                exit();
            } else if ($action === 'destroy') {
                $this->handleDestroy($page);
            }
        }
    }

    /**
     * Handle requests for creating a new page.
     */
    public function handleCreate()
    {
        return 'qwe';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pageRepository = new PageRepository;
            $page = $pageRepository->create($_POST);
            if ($page) {
                phpb_redirect(phpb_url('website_manager'), [
                    'message-type' => 'success',
                    'message' => phpb_trans('website-manager.page-created')
                ]);
            }
        }

        $this->renderPageSettings();
    }

    /**
     * Handle requests for editing the given page.
     *
     * @param PageContract $page
     */
    public function handleEdit(PageContract $page)
    {
        return 'qwe';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pageRepository = new PageRepository;
            $success = $pageRepository->update($page, $_POST);
            if ($success) {
                phpb_redirect(phpb_url('website_manager'), [
                    'message-type' => 'success',
                    'message' => phpb_trans('website-manager.page-updated')
                ]);
            }
        }

        $this->renderPageSettings($page);
    }

    /**
     * Handle requests to destroy the given page.
     *
     * @param PageContract $page
     */
    public function handleDestroy(PageContract $page)
    {
        return 'qwe';
        $pageRepository = new PageRepository;
        $pageRepository->destroy($page->getId());
        phpb_redirect(phpb_url('website_manager'), [
            'message-type' => 'success',
            'message' => phpb_trans('website-manager.page-deleted')
        ]);
    }

    /**
     * Handle requests for updating the website settings.
     */
    public function handleUpdateSettings()
    {
        return 'qwe';
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

    /**
     * Render the website manager overview page.
     */
    public function renderOverview()
    {
        $pageRepository = new PageRepository;
        $pages = $pageRepository->getAll();

        $viewFile = 'overview';
        $data['viewFile'] = $viewFile;
        // return view('pagebuilder.master', $data);
        header("location: pages/overview");
        exit;
        // require __DIR__ . '/../../../../resources/views/pagebuilder/master.blade.php';
    }
    private function renderOverviewDisplay () {
        return view('layouts.app');
    }

    /**
     * Render the website manager page settings (add/edit page form).
     *
     * @param PageContract $page
     */
    public function renderPageSettings(PageContract $page = null)
    {
        return 'qwe';
        $action = isset($page) ? 'edit' : 'create';
        $theme = phpb_instance('theme', [phpb_config('theme'), phpb_config('theme.active_theme')]);

        $viewFile = 'page-settings';
        $data['viewFile'] = $viewFile;
        return view('pagebuilder.master', $data);
        require __DIR__ . '/../../../../resources/views/pagebuilder/master.blade.php';
        // require __DIR__ . '/resources/layouts/master.php';
    }

    /**
     * Render the website manager menu settings (add/edit menu form).
     */
    public function renderMenuSettings()
    {
        return 'qwe';
        $viewFile = 'menu-settings';
        $data['viewFile'] = $viewFile;
        return view('pagebuilder.master', $data);
        require __DIR__ . '/../../../../resources/views/pagebuilder/master.blade.php';
        // require __DIR__ . '/resources/layouts/master.php';
    }

    /**
     * Render a thumbnail for each theme block.
     */
    public function renderBlockThumbs()
    {
        return 'qwe';
        $viewFile = 'block-thumbs';
        $data['viewFile'] = $viewFile;
        return view('pagebuilder.master', $data);
        require __DIR__ . '/../../../../resources/views/pagebuilder/master.blade.php';
        // require __DIR__ . '/resources/layouts/master.php';
    }

    /**
     * Render the website manager welcome page for installations without a homepage.
     */
    public function renderWelcomePage()
    {
        return 'qwe';
        $viewFile = 'welcome';
        $data['viewFile'] = $viewFile;
        return view('pagebuilder.master', $data);
        require __DIR__ . '/resources/layouts/empty.php';
    }
}
