<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Repositories\Admin\MenuRepositoryEloquent as Menu;
use App\Repositories\Admin\PageRepositoryEloquent as Page;
use App\Repositories\Admin\PageRowRepositoryEloquent as PageRow;
use App\Repositories\Admin\PageColumnRepositoryEloquent as PageColumn;
use App\Repositories\Admin\PageContentRepositoryEloquent as PageContent;
use App\Repositories\Admin\PageSectionRepositoryEloquent as PageSection;
use App\Repositories\Admin\PageStaticRepositoryEloquent as PageStatic;

class PageController extends Controller
{
    protected $pageRepo;
    protected $menuRepo;
    protected $sectionRepo;
    protected $rowRepo;
    protected $columnRepo;
    protected $contentRepo;
    protected $staticRepo;

    function __construct(Page $pageRepo, Menu $menuRepo, PageSection $sectionRepo, PageRow $rowRepo, PageColumn $columnRepo, PageContent $contentRepo, PageStatic $staticRepo)
    {
        $this->pageRepo = $pageRepo;
        $this->menuRepo = $menuRepo;
        $this->sectionRepo = $sectionRepo;
        $this->rowRepo = $rowRepo;
        $this->columnRepo = $columnRepo;
        $this->contentRepo = $contentRepo;
        $this->staticRepo = $staticRepo;
    }

    public function index()
    {
        $data['pages'] = $this->pageRepo->all();
        return view('admin.settings.pages.index', $data);
    }

    public function store(PageRequest $request)
    {
        $field = $request->file('background_image');
        $hasfile = $request->hasFile('background_image');
        $bgimage = fileUpload('uploads/pages', $field, $hasfile);
        $makeRequest = [
            'title' => $request['title'],
            'slug_title' => Str::slug($request['title']),
            'background_color' => ($request['background_color']) ? $request['background_color'] : '#eee',
            'background_image' => $bgimage
        ];
        $this->pageRepo->create($makeRequest);
        $this->menuRepo->create([
            'name' => $request['title'],
            'menu_url' => Str::slug($request['title'])
        ]);
        return redirect()->route('pages.index');
    }

    public function show($id)
    {
        $data['page'] = $this->pageRepo->find($id);
        $data['page_id'] = $id;
        $data['sections'] = $this->sectionRepo->rawWith(['row.column.content'], "page_id = ?", [$id], "order_id");
        $data['chksection'] = $this->sectionRepo->rawCount("page_id = ?", [$id]);
        $data['ratio'] = [
            1 => '6:6', 2 => '4:8', 3 => '3:9', 4 => '8:4', 5 => '9:3'
        ];
        $data['videoratio'] = [
            1 => '21:9', 2 => '16:9', 3 => '4:3', 4 => '1:1'
        ];
        $data['alignment'] = ['Left' => 'Left', 'Center' => 'Center', 'Right' => 'Right'];
        
        if(in_array($id, [1,2,3,4])){
            $data['page_id'] = $id;
            $data['pval'] = $this->pageRepo->find($id);
            $data['page'] = $this->staticRepo->findByField('page_id', $id);
            return view('admin.settings.pages.fixed', $data);
        }
        return view('admin.settings.pages.show', $data);
    }

    public function manage(Request $request)
    {
        $type = $request['type'];
        $page_id = $request['page_id'];
        switch ($type) {
            case 'section':
                
                $section_id = $request['section_id'];
                $path = 'uploads/pages';
                $field = $request->file('background_image');
                $hasfile = $request->hasFile('background_image');
                if($section_id){
                    $section = $this->sectionRepo->find($section_id);
                    $background_image = fileUpload($path, $field, $hasfile, $section->background_image);
                    $makeRequest = [
                        'page_id' => $request['page_id'],
                        'header' => $request['header'],
                        'sub_header' => $request['sub_header'],
                        'background_color' => $request['background_color'],
                        'background_image' => $background_image,
                        'class_name' => 'section-'.Str::random(10),
                        'header_color' => $request['header_color'],
                        'sub_header_color' => $request['sub_header_color'],
                        'header_class' => 'header-'.Str::random(10),
                        'sub_header_class' => 'sub-header-'.Str::random(10)
                    ];
                    $this->sectionRepo->update($makeRequest, $section_id);
                    $page = $this->pageRepo->find($page_id);
                    
                    $csscontent  = ".".$makeRequest['class_name']." {";
                    if($makeRequest['background_image']){
                        $csscontent .= "background-image: url(../../".$makeRequest['background_image'].");";
                        $csscontent .= "background-position: 100% 100%;";
                        $csscontent .= "background-size: cover;";
                    } else {
                        $csscontent .= "background-color: ".$makeRequest['background_color'].";";
                    }
                    $csscontent .= "height: 100%;";
                    $csscontent .= "}\n";
                    $csscontent .= ".".$makeRequest['header_class']." {";
                    $headercolor = ($makeRequest['header_color'] == 'light') ? '#fafafa' : '#333';
                    $csscontent .= "color: ".$headercolor.";";
                    $csscontent .= "}\n";
                    $csscontent .= ".".$makeRequest['sub_header_class']." {";
                    $subheadercolor = ($makeRequest['sub_header_color'] == 'light') ? '#fafafa' : '#333';
                    $csscontent .= "color: ".$subheadercolor.";";
                    $csscontent .= "width: 100%;display: block;position: relative;";
                    $csscontent .= "}\n";
                    writeClass($page->slug_title, $csscontent);
                    return redirect()->route('pages.show', ['page' => $page_id]);
                }
                $background_image = fileUpload($path, $field, $hasfile);
                $makeRequest = [
                    'page_id' => $request['page_id'],
                    'header' => $request['header'],
                    'sub_header' => $request['sub_header'],
                    'background_color' => $request['background_color'],
                    'background_image' => $background_image,
                    'class_name' => 'section-'.Str::random(10),
                    'header_color' => $request['header_color'],
                    'sub_header_color' => $request['sub_header_color'],
                    'header_class' => 'header-'.Str::random(10),
                    'sub_header_class' => 'sub-header-'.Str::random(10)
                ];
                $section = $this->sectionRepo->create($makeRequest);
                $page = $this->pageRepo->find($page_id);
                
                $csscontent  = ".".$makeRequest['class_name']." {";
                if($makeRequest['background_image']){
                    $csscontent .= "background-image: url(../../".$makeRequest['background_image'].");";
                    $csscontent .= "background-position: 100% 100%;";
                    $csscontent .= "background-size: cover;";
                } else {
                    $csscontent .= "background-color: ".$makeRequest['background_color'].";";
                }
                $csscontent .= "height: 100%;";
                $csscontent .= "}\n";
                $csscontent .= ".".$makeRequest['header_class']." {";
                $headercolor = ($makeRequest['header_color'] == 'light') ? '#fafafa' : '#333';
                $csscontent .= "color: ".$headercolor.";";
                $csscontent .= "}\n";
                $csscontent .= ".".$makeRequest['sub_header_class']." {";
                $subheadercolor = ($makeRequest['sub_header_color'] == 'light') ? '#fafafa' : '#333';
                $csscontent .= "color: ".$subheadercolor.";";
                $csscontent .= "width: 100%;display: block;position: relative;";
                $csscontent .= "}\n";
                writeClass($page->slug_title, $csscontent);
                return redirect()->route('pages.show', ['page' => $page_id]);

                break;

            case 'row':
                
                $columns = $request['columns'];
                $makeRequest = [
                    'section_id' => $request['section_id'],
                    'columns' => $columns,
                    'column_ratio' => $request['column_ratio']
                ];
                $row = $this->rowRepo->create($makeRequest);
                for ($i=1; $i <= $columns; $i++) { 
                    $this->columnRepo->create(['row_id' => $row->id, 'section_id' => $request['section_id']]);
                }
                return redirect()->route('pages.show', ['page' => $page_id]);

                break;

            case 'paragraph':
                
                $content = $request['paragraph'];
                $color = ($request['paragraph_color'] == 'light') ? '#fafafa' : '#333';
                if($request['content_id']){
                    $this->contentRepo->update([
                        'column_id' => $request['column_id'],
                        'column' => $request['column'],
                        'content_type'  => $type,
                        'content_value' => json_encode([
                            'content' => $content,
                            'color' => $color
                        ])
                    ], $request['content_id']);
                    return redirect()->back();
                }
                $this->contentRepo->create([
                    'column_id' => $request['column_id'],
                    'column' => $request['column'],
                    'content_type'  => $type,
                    'content_value' => json_encode([
                        'content' => $content,
                        'color' => $color
                    ])
                ]);
                return redirect()->back();

                break;

            case 'header':

                if($request['content_id']){
                    $this->contentRepo->update([
                        'column_id' => $request['column_id'],
                        'column' => $request['column'],
                        'content_type'  => $type,
                        'content_value' => json_encode([
                            'header' => $request['header']
                        ])
                    ], $request['content_id']);
                    return redirect()->back();
                }
                $this->contentRepo->create([
                    'column_id' => $request['column_id'],
                    'column' => $request['column'],
                    'content_type'  => $type,
                    'content_value' => json_encode([
                        'header' => $request['header']
                    ])
                ]);
                return redirect()->back();

                break;

            case 'image':

                $path = 'uploads/pages';
                $field = $request->file('image');
                $hasfile = $request->hasFile('image');
                if($request['align'] == 'Left'){
                    $class = 'float-left';
                } elseif($request['align'] == 'Center'){
                    $class = 'text-center';
                } else {
                    $class = 'float-right';
                }

                if($request['content_id']){
                    $content = $this->contentRepo->find($request['content_id']);
                    $result = json_decode($content->content_value);
                    $image = fileUpload($path, $field, $hasfile, $result->image);
                    $this->contentRepo->update([
                        'column_id' => $request['column_id'],
                        'column' => $request['column'],
                        'content_type'  => $type,
                        'content_value' => json_encode([
                            'image' => $image,
                            'class' => $class
                        ])
                    ], $request['content_id']);
                    return redirect()->back();
                }
                $image = fileUpload($path, $field, $hasfile);
                $this->contentRepo->create([
                    'column_id' => $request['column_id'],
                    'column' => $request['column'],
                    'content_type'  => $type,
                    'content_value' => json_encode([
                        'image' => $image,
                        'class' => $class
                    ])
                ]);
                return redirect()->back();

                break;

            case 'video':

                $url = convertYoutube($request['youtube_url']);
                $vratio = $request['ratio'];
                if($vratio == 1){
                    $ratio = 'embed-responsive-21by9';
                } elseif($vratio == 2){
                    $ratio = 'embed-responsive-16by9';
                } elseif($vratio == 3){
                    $ratio = 'embed-responsive-4by3';
                } else {
                    $ratio = 'embed-responsive-1by1';
                }
                if($request['content_id']){
                    $this->contentRepo->update([
                        'column_id' => $request['column_id'],
                        'column' => $request['column'],
                        'content_type'  => $type,
                        'content_value' => json_encode([
                            'youtube_url' => $url,
                            'ratio' => $ratio
                        ])
                    ], $request['content_id']);
                    return redirect()->back();
                }
                $this->contentRepo->create([
                    'column_id' => $request['column_id'],
                    'column' => $request['column'],
                    'content_type'  => $type,
                    'content_value' => json_encode([
                        'youtube_url' => $url,
                        'ratio' => $ratio
                    ])
                ]);
                return redirect()->back();

                break;

            case 'link':

                if($request['content_id']){
                    $this->contentRepo->update([
                        'column_id' => $request['column_id'],
                        'column' => $request['column'],
                        'content_type'  => $type,
                        'content_value' => json_encode([
                            'link_url' => $request['link_url'],
                            'link_value' => $request['link_value'],
                            'link_target' => $request['link_target']
                        ])
                    ], $request['content_id']);
                    return redirect()->back();
                }
                $this->contentRepo->create([
                    'column_id' => $request['column_id'],
                    'column' => $request['column'],
                    'content_type'  => $type,
                    'content_value' => json_encode([
                        'link_url' => $request['link_url'],
                        'link_value' => $request['link_value'],
                        'link_target' => $request['link_target']
                    ])
                ]);
                return redirect()->back();

                break;

            case 'section_order':

                $arr = explode(',', $request['ids']);
                foreach(array_filter($arr) as $sortOrder => $id){
                    $this->sectionRepo->update(['order_id' => $sortOrder], $id);
                }

                break;
            
            default:
                # code...
                break;
        }
    }

    public function pagecontent($id)
    {
        $content = $this->contentRepo->find($id);
        $result = json_decode($content->content_value);
        $data['content'] = (isset($result->content)) ? $result->content : '';
        $data['header'] = (isset($result->header)) ? $result->header : '';
        $data['image'] = (isset($result->image)) ? $result->image : '';
        $data['baseimage'] = (isset($result->image)) ? basename($result->image) : '';
        $alignment = (isset($result->class)) ? $result->class : '';
        $data['youtube_url'] = (isset($result->youtube_url)) ? $result->youtube_url : '';
        $vratio = (isset($result->ratio)) ? $result->ratio : '';
        $data['link_url'] = (isset($result->link_url)) ? $result->link_url : '';
        $data['link_value'] = (isset($result->link_value)) ? $result->link_value : '';
        $data['link_target'] = (isset($result->link_target)) ? $result->link_target : '';
        if($alignment === 'float-left'){
            $align = 'Left';
        } elseif($alignment === 'text-center'){
            $align = 'Center';
        } else {
            $align = 'Right';
        }
        $data['align'] = $align;

        if($vratio === 'embed-responsive-21by9'){
            $data['ratio'] = 1;
        } elseif($vratio === 'embed-responsive-16by9'){
            $data['ratio'] = 2;
        } elseif($vratio === 'embed-responsive-4by3'){
            $data['ratio'] = 3;
        } else {
            $data['ratio'] = 4;
        }
        return response()->json($data);
    }

    public function pageimage($id)
    {
        $content = $this->contentRepo->find($id);
        $result = json_decode($content->content_value);
        if(File::delete($result->image)){
            $this->contentRepo->update([
                'content_value' => json_encode([
                    'image' => '',
                    'class' => $result->class
                ])
            ], $id);
        }
        $data['response'] = 1;
        return response()->json($data);
    }

    public function pagesection($id)
    {
        $data['section'] = $section = $this->sectionRepo->find($id);
        $data['bg_image'] = basename($section->background_image);
        return response()->json($data);
    }

    public function pagesectionimage($id)
    {
        $section = $this->sectionRepo->find($id);
        if(File::delete($section->background_image)){
            $this->sectionRepo->update(['background_image' => ''], $id);
        }
        $data['response'] = 1;
        return response()->json($data);
    }

    public function storestatic(Request $request)
    {
        $type = $request['type'];
        $page_id = $request['page_id'];
        $static = $this->staticRepo->findByField("page_id", $page_id);
        if(!empty($static)){
            $result = json_decode($static->content);
            switch ($type) {

                case 'about':

                    $path = 'uploads/pages/static';
                    $bgimage1field = $request->file('bgimage1');
                    $bgimage1hasfile = $request->hasFile('bgimage1');
                    $bgimage1 = fileUpload($path, $bgimage1field, $bgimage1hasfile, $result->image1);
    
                    $bgimage2field = $request->file('bgimage2');
                    $bgimage2hasfile = $request->hasFile('bgimage2');
                    $bgimage2 = fileUpload($path, $bgimage2field, $bgimage2hasfile, $result->image2);
    
                    $bgimage3field = $request->file('bgimage3');
                    $bgimage3hasfile = $request->hasFile('bgimage3');
                    $bgimage3 = fileUpload($path, $bgimage3field, $bgimage3hasfile, $result->image3);
    
                    $makeRequest = [
                        'page_id' => $page_id,
                        'content' => json_encode([
                            'image1' => $bgimage1,
                            'image2' => $bgimage2,
                            'image3' => $bgimage3,
                            'header_2' => $request['header_2'],
                            'text_2' => $request['text_2'],
                            'header_3' => $request['header_3'],
                            'text_3' => $request['text_3'],
                            'header_4' => $request['header_4'],
                            'text_4' => $request['text_4'],
                            'social' => [
                                'text' => $request['social_text'],
                                'facebook' => $request['facebook'],
                                'twitter' => $request['twitter'],
                                'instagram' => $request['instagram'],
                                'youtube' => $request['youtube']
                            ]
                        ])
                    ];
    
                    $this->staticRepo->update($makeRequest, $static->id);
                    return redirect()->back();
    
                    break;

                case 'contact':

                    $path = 'uploads/pages/static';
                    $field = $request->file('bgimage4');
                    $hasfile = $request->hasFile('bgimage4');
                    $image = fileUpload($path, $field, $hasfile, $result->image);
                    $makeRequest = [
                        'page_id' => $page_id,
                        'content' => json_encode([
                            'google_map' => $request['google_map'],
                            'header' => $request['header'],
                            'image' => $image,
                            'schedule' => $request['schedule'],
                            'location' => $request['location'],
                            'contact' => $request['contact'],
                            'email' => $request['email']
                        ])
                    ];
    
                    $this->staticRepo->update($makeRequest, $static->id);
                    return redirect()->back();
    
                    break;

                case 'about':

                    $path = 'uploads/pages/static';
                    $bgimage1field = $request->file('bgimage1');
                    $bgimage1hasfile = $request->hasFile('bgimage1');
                    $bgimage1 = fileUpload($path, $bgimage1field, $bgimage1hasfile);

                    $bgimage2field = $request->file('bgimage2');
                    $bgimage2hasfile = $request->hasFile('bgimage2');
                    $bgimage2 = fileUpload($path, $bgimage2field, $bgimage2hasfile);

                    $bgimage3field = $request->file('bgimage3');
                    $bgimage3hasfile = $request->hasFile('bgimage3');
                    $bgimage3 = fileUpload($path, $bgimage3field, $bgimage3hasfile);

                    $makeRequest = [
                        'page_id' => $page_id,
                        'content' => json_encode([
                            'image1' => $bgimage1,
                            'image2' => $bgimage2,
                            'image3' => $bgimage3,
                            'header_2' => $request['header_2'],
                            'text_2' => $request['text_2'],
                            'header_3' => $request['header_3'],
                            'text_3' => $request['text_3'],
                            'header_4' => $request['header_4'],
                            'text_4' => $request['text_4'],
                            'social' => [
                                'text' => $request['social_text'],
                                'facebook' => $request['facebook'],
                                'twitter' => $request['twitter'],
                                'instagram' => $request['instagram'],
                                'youtube' => $request['youtube']
                            ]
                        ])
                    ];

                    $this->staticRepo->create($makeRequest);
                    return redirect()->back();

                    break;

                case 'home':
            
                    $path = 'uploads/pages/static';
                    $field1 = $request->file('image1');
                    $hasfile1 = $request->hasFile('image1');
                    $image1 = fileUpload($path, $field1, $hasfile1, $result->image1);
    
                    $field2 = $request->file('image2');
                    $hasfile2 = $request->hasFile('image2');
                    $image2 = fileUpload($path, $field2, $hasfile2, $result->image2);
    
                    $makeRequest = [
                        'page_id' => $page_id,
                        'content' => json_encode([
                            'header1' => $request['header1'],
                            'image1' => $image1,
                            'image2' => $image2,
                            'header2' => $request['header2'],
                            'sub_header' => $request['sub_header'],
                            'text1' => $request['text1'],
                            'content1' => $request['content1'],
                            'text2' => $request['text2'],
                            'content2' => $request['content2'],
                            'text3' => $request['text3'],
                            'content3' => $request['content3'],
                            'text4' => $request['text4'],
                            'content4' => $request['content4'],
                            'card1h' => $request['card1h'],
                            'card1t' => $request['card1t'],
                            'card2h' => $request['card2h'],
                            'card2t' => $request['card2t'],
                            'card3h' => $request['card3h'],
                            'card3t' => $request['card3t'],
                            'google_map' => $request['google_map']
                        ])
                    ];
    
                    $this->staticRepo->update($makeRequest, $static->id);
                    return redirect()->back();
    
                    break;
    
                case 'image':
    
                    $image = $request['image'];
                    File::delete($image);
                    $data['response'] = 1;
                    return response()->json($data);
    
                    break;
                
            }
        }

        switch ($type) {

            case 'about':

                $path = 'uploads/pages/static';
                $bgimage1field = $request->file('bgimage1');
                $bgimage1hasfile = $request->hasFile('bgimage1');
                $bgimage1 = fileUpload($path, $bgimage1field, $bgimage1hasfile);

                $bgimage2field = $request->file('bgimage2');
                $bgimage2hasfile = $request->hasFile('bgimage2');
                $bgimage2 = fileUpload($path, $bgimage2field, $bgimage2hasfile);

                $bgimage3field = $request->file('bgimage3');
                $bgimage3hasfile = $request->hasFile('bgimage3');
                $bgimage3 = fileUpload($path, $bgimage3field, $bgimage3hasfile);

                $makeRequest = [
                    'page_id' => $page_id,
                    'content' => json_encode([
                        'image1' => $bgimage1,
                        'image2' => $bgimage2,
                        'image3' => $bgimage3,
                        'header_2' => $request['header_2'],
                        'text_2' => $request['text_2'],
                        'header_3' => $request['header_3'],
                        'text_3' => $request['text_3'],
                        'header_4' => $request['header_4'],
                        'text_4' => $request['text_4'],
                        'social' => [
                            'text' => $request['social_text'],
                            'facebook' => $request['facebook'],
                            'twitter' => $request['twitter'],
                            'instagram' => $request['instagram'],
                            'youtube' => $request['youtube']
                        ]
                    ])
                ];

                $this->staticRepo->create($makeRequest);
                return redirect()->back();

                break;

            case 'contact':

                $path = 'uploads/pages/static';
                $field = $request->file('bgimage4');
                $hasfile = $request->hasFile('bgimage4');
                $image = fileUpload($path, $field, $hasfile);
                $makeRequest = [
                    'page_id' => $page_id,
                    'content' => json_encode([
                        'google_map' => $request['google_map'],
                        'header' => $request['header'],
                        'image' => $image,
                        'schedule' => $request['schedule'],
                        'location' => $request['location'],
                        'contact' => $request['contact'],
                        'email' => $request['email']
                    ])
                ];

                $this->staticRepo->create($makeRequest);
                return redirect()->back();

                break;

            case 'home':
                
                $path = 'uploads/pages/static';
                $field1 = $request->file('image1');
                $hasfile1 = $request->hasFile('image1');
                $image1 = fileUpload($path, $field1, $hasfile1);

                $field2 = $request->file('image2');
                $hasfile2 = $request->hasFile('image2');
                $image2 = fileUpload($path, $field2, $hasfile2);

                $makeRequest = [
                    'page_id' => $page_id,
                    'content' => json_encode([
                        'header1' => $request['header1'],
                        'image1' => $image1,
                        'image2' => $image2,
                        'header2' => $request['header2'],
                        'sub_header' => $request['sub_header'],
                        'text1' => $request['text1'],
                        'content1' => $request['content1'],
                        'text2' => $request['text2'],
                        'content2' => $request['content2'],
                        'text3' => $request['text3'],
                        'content3' => $request['content3'],
                        'text4' => $request['text4'],
                        'content4' => $request['content4'],
                        'card1h' => $request['card1h'],
                        'card1t' => $request['card1t'],
                        'card2h' => $request['card2h'],
                        'card2t' => $request['card2t'],
                        'card3h' => $request['card3h'],
                        'card3t' => $request['card3t'],
                        'google_map' => $request['google_map']
                    ])
                ];

                $this->staticRepo->create($makeRequest);
                return redirect()->back();

                break;

            case 'image':

                $image = $request['image'];
                File::delete($image);
                $data['response'] = 1;
                return response()->json($data);

                break;
            
        }
    }

    public function edit($id)
    {
        $data['page'] = $this->pageRepo->find($id);
        return response()->json($data);
    }

    public function removesection($id)
    {
        $section = $this->sectionRepo->find($id);
        $column = $this->columnRepo->findByField('section_id', $id);
        $this->contentRepo->deleteRaw("column_id = ?", [$column->id]);
        $this->columnRepo->deleteRaw("section_id = ?", [$id]);
        $this->sectionRepo->delete($id);
        $data['response'] = 1;
        return response()->json($data);
    }
}
