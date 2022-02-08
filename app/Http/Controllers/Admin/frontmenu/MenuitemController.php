<?php

namespace App\Http\Controllers\Admin\frontmenu;

use App\Models\Admin\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\blog\category;
use App\Models\Teams\Teamcategory;
use App\Models\Frontmenu\Frontmenu;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Frontmenu\Frontmenuitem;
use App\Models\general_content\Contentcategory;
use Arr;
use PhpParser\Node\Expr\Cast\Array_;

class MenuitemController extends Controller
{
    public function index($id)
    {
        Gate::authorize('app.front.menuitems.widgetbuilder');
        $menu = Frontmenu::findOrFail($id);
        $auth = Auth::guard('admin')->user();
        $pages = Page::all();
        $categories = category::where('parent_id', '=', 0)->get();
        $contentcategories = Contentcategory::where('parent_id', '=', 0)->get();
        $teamcategories = Teamcategory::where('parent_id', '=', 0)->get();
        return view('backend.admin.frontmenu.builder',compact('menu','auth','pages','categories','contentcategories','teamcategories'));
    }

    // public function show()
    // {
    //     $menuitem = Frontmenuitem::all();
    //     return response()->json([
    //         'menuitem' => $menuitem,
    //     ]);
    // }

    public function create($id)
    {
        $menu = Frontmenu::findOrFail($id);
        return view('backend.admin.frontmenu.menuitem.form',compact('menu'));
    }

    public function store(Request $request,$id)
    {
        $this->validate($request,[
            'title' => 'required'
        ],
        [
            'title.required' => 'Menu Order already changed. check in Home-page Please!',
        ]);

        $contentcategory_id = null;
        $blogcategory_id = null;
         $page_id = null;
        // foreach($request->input('slug') as $key => $value) {
        //     $slug = $request->input('slug')[$key];

        // }
        // foreach($request->input('id') as $key => $value) {
        //     $content_id = $request->input('id')[$key];
        // }

        // $contentcategory = Contentcategory::all();
        // foreach($contentcategory  as $cat)
        // {
        //     if($cat->slug == $slug)
        //     {
        //         $contentcategory_id = $content_id;
        //     }
        //     else
        //     {
        //         $contentcategory_id = null;
        //     }

        // }

        // $blogcategory = category::all();
        // foreach($blogcategory  as $blogcat)
        // {
        //     if($blogcat->slug == $slug)
        //     {
        //         $blogcategory_id = $content_id;
        //     }
        //     else
        //     {
        //         $blogcategory_id = null;
        //     }

        // }

        // $page = Page::all();
        // foreach($page  as $page)
        // {
        //     if($page->slug == $slug)
        //     {
        //         $page_id = $content_id;
        //     }
        //     else
        //     {
        //         $page_id = null;
        //     }

        // }





        $menu = Frontmenu::findOrFail($id);

        // foreach($request->input('title') as $key => $value) {
        //     $title = $request->input('title')[$key];


        // $menu->menuItems()->create([
        //     'title' => ucwords(str_replace('-', ' ', $title)),
        //     'slug' => $request->input('title')[$key],
        //     //'type' => $request->type,
        //     //'divider_title' => $request->divider_title,
        //     //'target' => $request->target,
        // ]);

        // $contentcategory = Contentcategory::all();
        //$data = array();
        foreach($request->input('title') as $key => $value) {
            $title = $request->input('title')[$key];
            $slugg = $request->input('slug')[$key];
            $content_id = $request->input('id')[$key];

            if(category::where('slug','=',$slugg)->count() > 0)
            {
                $blogcategory = category::where('slug','=',$slugg)->first();

                $blogcategory_id = $blogcategory->id;
            }
            else{
                $blogcategory_id = null;
            }


            if(Contentcategory::where('slug','=',$slugg)->count() > 0)
            {
                $contentcategory = Contentcategory::where('slug','=',$slugg)->first();

                $contentcategory_id = $contentcategory->id;
            }
            else{
                $contentcategory_id = null;
            }

            if(Page::where('slug','=',$slugg)->count() > 0)
            {
                $page = Page::where('slug','=',$slugg)->first();
                $page_id = $page->id;
            }
            else
            {
                $page_id = null;
            }



        // foreach($blogcategory  as $blogcat)
        // {
        //     if($blogcat->slug == $slugg)
        //     {
        //         $blogcategory_id = $content_id;
        //     }
        //     else
        //     {
        //         $blogcategory_id = null;
        //     }
        // }

        // foreach($contentcategory  as $cat)
        // {
        //     if($cat->slug == $slugg)
        //     {
        //         $contentcategory_id = $cat->id;
        //     }
        //     else
        //     {
        //         $contentcategory_id = null;
        //     }

        // }

        // array_push($data,$item);
        $menu->menuItems()->create([
            'title' => $title,
            'slug' => $slugg,
            'contentcategory_id' => $contentcategory_id,
            'blogcategory_id' => $blogcategory_id,
            'page_id' => $page_id,
        ]);
        }

        // dd($data);

        // $result = explode(",",$data);

        // dd($result);
        // return $result;
        // $result = [];
        // foreach($data as $key=>$menu){
        //     $result[]=$menu;

        //     $menu->menuItems()->create($menu[$key]);

        // }

        // dd($result);



        notify()->success('Menu Item Added','Added');
        return redirect()->route('admin.menuitem.builder',$menu->id);
    }

    public function menustore(Request $request,$id)
    {
        $menu = Frontmenu::findOrFail($id);
        $menu->menuItems()->create([
            'title' => $request->title,
            'url' => $request->url,
        ]);
        return back();
    }

    public function order(Request $request, $id)
    {
        $menu = Frontmenu::findOrFail($id);
        $menuItemOrder = json_decode($request->get('order'));
        $this->orderMenu($menuItemOrder,0);
    }

    private function orderMenu(array $menuItems, $parentId)
    {
        foreach($menuItems as $index => $item)
        {
            $menutItem = Frontmenuitem::findOrFail($item->id);
            $menutItem->update([
                'order' => $index + 1,
                'parent_id' => $parentId
            ]);

            if(isset($item->children))
            {
                $this->orderMenu($item->children,$menutItem->id);
            }

        }
    }

    public function edit($id,$menuId)
    {

        $menu = Frontmenu::findOrFail($id);
        $auth = Auth::guard('admin')->user();
        //$menuitemm = $menu->menuItems()->first($menuId);
        $menuitemm = Frontmenuitem::find($menuId);
        $pages = Page::all();
        $categories = category::where('parent_id', '=', 0)->get();
        $contentcategories = Contentcategory::where('parent_id', '=', 0)->get();
        $teamcategories = Teamcategory::where('parent_id', '=', 0)->get();
        return view('backend.admin.frontmenu.builder',compact('menu','auth','menuitemm','pages','categories','contentcategories','teamcategories'));
    }

    public function update(Request $request,$menuId)
    {
        $frontmenu = Frontmenuitem::findOrFail($menuId);
        if($request->slug)
        {
            $slug = $request->slug;
        }
        else
        {
            $slug = null;
        }
        if($request->url)
        {
            $url = $request->url;
        }
        else
        {
            $url = null;
        }
        $frontmenu->update([
            'title' => $request->title,
            'slug' => $slug,
            'url' => $url,
        ]);
        notify()->success('Menu Updated Successfully');
        return back();
    }

    public function destroy($id,$menuId)
    {
        Frontmenuitem::findOrFail($menuId)
                 ->delete();

        notify()->success('Menu Delete Successfully');
        return back();
    }
}
