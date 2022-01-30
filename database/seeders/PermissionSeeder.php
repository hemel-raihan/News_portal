<?php

namespace Database\Seeders;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleAppDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppDashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'app.dashboard'
        ]);

        $moduleAppRole = Module::updateOrCreate(['name' => 'Role Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'View (Global)',
            'slug' => 'app.roles.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'View (Self)',
            'slug' => 'app.roles.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Create Role',
            'slug' => 'app.roles.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Edit Role',
            'slug' => 'app.roles.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Delete Role',
            'slug' => 'app.roles.destroy'
        ]);



        $moduleAppUser = Module::updateOrCreate(['name' => 'User Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'View (Global)',
            'slug' => 'app.users.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'View (Self)',
            'slug' => 'app.users.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Create User',
            'slug' => 'app.users.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Edit User',
            'slug' => 'app.users.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Delete User',
            'slug' => 'app.users.destroy'
        ]);


        $moduleAppProductCategory = Module::updateOrCreate(['name' => 'Product-Category Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppProductCategory->id,
            'name' => 'View (Global)',
            'slug' => 'app.product.categories.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductCategory->id,
            'name' => 'View (Self)',
            'slug' => 'app.product.categories.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductCategory->id,
            'name' => 'Create ProductCategory',
            'slug' => 'app.product.categories.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductCategory->id,
            'name' => 'Edit ProductCategory',
            'slug' => 'app.product.categories.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductCategory->id,
            'name' => 'Delete ProductCategory',
            'slug' => 'app.product.categories.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductCategory->id,
            'name' => 'Approve ProductCategory',
            'slug' => 'app.product.categories.approve'
        ]);


        $moduleAppProductBrand = Module::updateOrCreate(['name' => 'Product-Brand Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppProductBrand->id,
            'name' => 'View (Global)',
            'slug' => 'app.product.brands.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductBrand->id,
            'name' => 'View (Self)',
            'slug' => 'app.product.brands.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductBrand->id,
            'name' => 'Create ProductBrand',
            'slug' => 'app.product.brands.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductBrand->id,
            'name' => 'Edit ProductBrand',
            'slug' => 'app.product.brands.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductBrand->id,
            'name' => 'Delete ProductBrand',
            'slug' => 'app.product.brands.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductBrand->id,
            'name' => 'Approve ProductBrand',
            'slug' => 'app.product.brands.approve'
        ]);


        $moduleAppProductAttribute = Module::updateOrCreate(['name' => 'Product-Attribute Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppProductAttribute->id,
            'name' => 'View (Global)',
            'slug' => 'app.product.attributes.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductAttribute->id,
            'name' => 'View (Self)',
            'slug' => 'app.product.attributes.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductAttribute->id,
            'name' => 'Create ProductAtribute',
            'slug' => 'app.product.attributes.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductAttribute->id,
            'name' => 'Edit ProductAtribute',
            'slug' => 'app.product.attributes.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductAttribute->id,
            'name' => 'Delete ProductAtribute',
            'slug' => 'app.product.attributes.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductAttribute->id,
            'name' => 'Approve ProductAtribute',
            'slug' => 'app.product.attributes.approve'
        ]);



        $moduleAppProductPost = Module::updateOrCreate(['name' => 'Product-Post Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppProductPost->id,
            'name' => 'View (Global)',
            'slug' => 'app.product.posts.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductPost->id,
            'name' => 'View (Self)',
            'slug' => 'app.product.posts.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductPost->id,
            'name' => 'Create ProductPost',
            'slug' => 'app.product.posts.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductPost->id,
            'name' => 'Edit ProductPost',
            'slug' => 'app.product.posts.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductPost->id,
            'name' => 'Details ProductPost',
            'slug' => 'app.product.posts.details'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductPost->id,
            'name' => 'Delete ProductPost',
            'slug' => 'app.product.posts.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductPost->id,
            'name' => 'Approve ProductPost',
            'slug' => 'app.product.posts.status'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppProductPost->id,
            'name' => 'Approve ProductPost',
            'slug' => 'app.product.posts.approve'
        ]);


        $moduleAppBlogCategory = Module::updateOrCreate(['name' => 'Blog-Category Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogCategory->id,
            'name' => 'View (Global)',
            'slug' => 'app.blog.categories.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogCategory->id,
            'name' => 'View (Self)',
            'slug' => 'app.blog.categories.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogCategory->id,
            'name' => 'Create BlogCategory',
            'slug' => 'app.blog.categories.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogCategory->id,
            'name' => 'Edit BlogCategory',
            'slug' => 'app.blog.categories.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogCategory->id,
            'name' => 'Delete BlogCategory',
            'slug' => 'app.blog.categories.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogCategory->id,
            'name' => 'Approve BlogCategory',
            'slug' => 'app.blog.categories.approve'
        ]);


        $moduleAppBlogPost = Module::updateOrCreate(['name' => 'Blog-Post Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogPost->id,
            'name' => 'View (Global)',
            'slug' => 'app.blog.posts.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogPost->id,
            'name' => 'View (Self)',
            'slug' => 'app.blog.posts.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogPost->id,
            'name' => 'Create BlogPost',
            'slug' => 'app.blog.posts.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogPost->id,
            'name' => 'Edit BlogPost',
            'slug' => 'app.blog.posts.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogPost->id,
            'name' => 'Details BlogPost',
            'slug' => 'app.blog.posts.details'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogPost->id,
            'name' => 'Delete BlogPost',
            'slug' => 'app.blog.posts.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogPost->id,
            'name' => 'Approve BlogPost',
            'slug' => 'app.blog.posts.status'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBlogPost->id,
            'name' => 'Approve BlogPost',
            'slug' => 'app.blog.posts.approve'
        ]);


        $moduleAppContentCategory = Module::updateOrCreate(['name' => 'Content-Category Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppContentCategory->id,
            'name' => 'View (Global)',
            'slug' => 'app.content.categories.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppContentCategory->id,
            'name' => 'View (Self)',
            'slug' => 'app.content.categories.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppContentCategory->id,
            'name' => 'Create ContentCategory',
            'slug' => 'app.content.categories.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppContentCategory->id,
            'name' => 'Edit ContentCategory',
            'slug' => 'app.content.categories.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppContentCategory->id,
            'name' => 'Delete ContentCategory',
            'slug' => 'app.content.categories.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppContentCategory->id,
            'name' => 'Approve ContentCategory',
            'slug' => 'app.content.categories.approve'
        ]);


        $moduleAppContentPost = Module::updateOrCreate(['name' => 'Content-Post Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppContentPost->id,
            'name' => 'View (Global)',
            'slug' => 'app.content.posts.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppContentPost->id,
            'name' => 'View (Self)',
            'slug' => 'app.content.posts.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppContentPost->id,
            'name' => 'Create ContentPost',
            'slug' => 'app.content.posts.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppContentPost->id,
            'name' => 'Edit ContentPost',
            'slug' => 'app.content.posts.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppContentPost->id,
            'name' => 'Details ContentPost',
            'slug' => 'app.content.posts.details'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppContentPost->id,
            'name' => 'Delete ContentPost',
            'slug' => 'app.content.posts.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppContentPost->id,
            'name' => 'Approve ContentPost',
            'slug' => 'app.content.posts.status'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppContentPost->id,
            'name' => 'Approve ContentPost',
            'slug' => 'app.content.posts.approve'
        ]);


        $moduleAppTeamCategory = Module::updateOrCreate(['name' => 'Team-Category Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamCategory->id,
            'name' => 'View (Global)',
            'slug' => 'app.team.categories.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamCategory->id,
            'name' => 'View (Self)',
            'slug' => 'app.team.categories.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamCategory->id,
            'name' => 'Create TeamCategory',
            'slug' => 'app.team.categories.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamCategory->id,
            'name' => 'Edit TeamCategory',
            'slug' => 'app.team.categories.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamCategory->id,
            'name' => 'Delete TeamCategory',
            'slug' => 'app.team.categories.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamCategory->id,
            'name' => 'Approve TeamCategory',
            'slug' => 'app.team.categories.approve'
        ]);


        $moduleAppTeamPost = Module::updateOrCreate(['name' => 'Team-Post Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamPost->id,
            'name' => 'View (Global)',
            'slug' => 'app.team.posts.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamPost->id,
            'name' => 'View (Self)',
            'slug' => 'app.team.posts.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamPost->id,
            'name' => 'Create TeamPost',
            'slug' => 'app.team.posts.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamPost->id,
            'name' => 'Edit TeamPost',
            'slug' => 'app.team.posts.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamPost->id,
            'name' => 'Details TeamPost',
            'slug' => 'app.team.posts.details'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamPost->id,
            'name' => 'Delete TeamPost',
            'slug' => 'app.team.posts.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamPost->id,
            'name' => 'Approve TeamPost',
            'slug' => 'app.team.posts.status'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppTeamPost->id,
            'name' => 'Approve TeamPost',
            'slug' => 'app.team.posts.approve'
        ]);


        $moduleAppPage = Module::updateOrCreate(['name' => 'Page Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'View (Global)',
            'slug' => 'app.pages.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'View (Self)',
            'slug' => 'app.pages.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Create Page',
            'slug' => 'app.pages.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Edit Page',
            'slug' => 'app.pages.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Details Page',
            'slug' => 'app.pages.details'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Delete Page',
            'slug' => 'app.pages.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Approve Page',
            'slug' => 'app.pages.status'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Approve Page',
            'slug' => 'app.pages.approve'
        ]);


        $moduleAppSidebar = Module::updateOrCreate(['name' => 'Sidebar Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppSidebar->id,
            'name' => 'View (Global)',
            'slug' => 'app.sidebars.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSidebar->id,
            'name' => 'View (Self)',
            'slug' => 'app.sidebars.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSidebar->id,
            'name' => 'Create Sidebar',
            'slug' => 'app.sidebars.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSidebar->id,
            'name' => 'Edit Sidebar',
            'slug' => 'app.sidebars.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSidebar->id,
            'name' => 'Delete Sidebar',
            'slug' => 'app.sidebars.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSidebar->id,
            'name' => 'Approve Sidebar',
            'slug' => 'app.sidebars.status'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppSidebar->id,
            'name' => 'Sidebar Builder',
            'slug' => 'app.sidebars.widgetbuilder'
        ]);


        $moduleAppWidget = Module::updateOrCreate(['name' => 'Widget Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppWidget->id,
            'name' => 'View (Global)',
            'slug' => 'app.widgets.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppWidget->id,
            'name' => 'View (Self)',
            'slug' => 'app.widgets.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppWidget->id,
            'name' => 'Create Widget',
            'slug' => 'app.widgets.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppWidget->id,
            'name' => 'Edit Widget',
            'slug' => 'app.widgets.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppWidget->id,
            'name' => 'Delete Widget',
            'slug' => 'app.widgets.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppWidget->id,
            'name' => 'Widget Builder',
            'slug' => 'app.widgets.widgetbuilder'
        ]);


        $moduleAppFrontMenu = Module::updateOrCreate(['name' => 'Front Menu Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppFrontMenu->id,
            'name' => 'View (Global)',
            'slug' => 'app.front.menus.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppFrontMenu->id,
            'name' => 'View (Self)',
            'slug' => 'app.front.menus.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppFrontMenu->id,
            'name' => 'Create Frontmenu',
            'slug' => 'app.front.menus.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppFrontMenu->id,
            'name' => 'Edit Frontmenu',
            'slug' => 'app.front.menus.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppFrontMenu->id,
            'name' => 'Delete Frontmenu',
            'slug' => 'app.front.menus.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppFrontMenu->id,
            'name' => 'Approve Frontmenu',
            'slug' => 'app.front.menus.status'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppFrontMenu->id,
            'name' => 'Menu Builder',
            'slug' => 'app.front.menus.widgetbuilder'
        ]);


        $moduleAppFrontmenuitem = Module::updateOrCreate(['name' => 'Widget Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppFrontmenuitem->id,
            'name' => 'View (Global)',
            'slug' => 'app.front.menuitems.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppFrontmenuitem->id,
            'name' => 'View (Self)',
            'slug' => 'app.front.menuitems.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppFrontmenuitem->id,
            'name' => 'Create Frontmenuitem',
            'slug' => 'app.front.menuitems.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppFrontmenuitem->id,
            'name' => 'Edit Frontmenuitem',
            'slug' => 'app.front.menuitems.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppFrontmenuitem->id,
            'name' => 'Delete Frontmenuitem',
            'slug' => 'app.front.menuitems.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppFrontmenuitem->id,
            'name' => 'menuitem Builder',
            'slug' => 'app.front.menuitems.widgetbuilder'
        ]);


        $moduleAppServiceCategory = Module::updateOrCreate(['name' => 'Service-Category Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppServiceCategory->id,
            'name' => 'View (Global)',
            'slug' => 'app.service.categories.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppServiceCategory->id,
            'name' => 'View (Self)',
            'slug' => 'app.service.categories.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppServiceCategory->id,
            'name' => 'Create ServiceCategory',
            'slug' => 'app.service.categories.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppServiceCategory->id,
            'name' => 'Edit ServiceCategory',
            'slug' => 'app.service.categories.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppServiceCategory->id,
            'name' => 'Delete ServiceCategory',
            'slug' => 'app.service.categories.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppServiceCategory->id,
            'name' => 'Approve ServiceCategory',
            'slug' => 'app.service.categories.approve'
        ]);


        $moduleAppServicePost = Module::updateOrCreate(['name' => 'Service-Post Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppServicePost->id,
            'name' => 'View (Global)',
            'slug' => 'app.service.posts.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppServicePost->id,
            'name' => 'View (Self)',
            'slug' => 'app.service.posts.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppServicePost->id,
            'name' => 'Create ServicePost',
            'slug' => 'app.service.posts.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppServicePost->id,
            'name' => 'Edit ServicePost',
            'slug' => 'app.service.posts.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppServicePost->id,
            'name' => 'Delete ServicePost',
            'slug' => 'app.service.posts.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppServicePost->id,
            'name' => 'Approve ServicePost',
            'slug' => 'app.service.posts.status'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppServicePost->id,
            'name' => 'Approve ServicePost',
            'slug' => 'app.service.posts.approve'
        ]);


        $moduleAppPortfolioCategory = Module::updateOrCreate(['name' => 'Portfolio-Category Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppPortfolioCategory->id,
            'name' => 'View (Global)',
            'slug' => 'app.portfolio.categories.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPortfolioCategory->id,
            'name' => 'View (Self)',
            'slug' => 'app.portfolio.categories.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPortfolioCategory->id,
            'name' => 'Create PortfolioCategory',
            'slug' => 'app.portfolio.categories.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPortfolioCategory->id,
            'name' => 'Edit PortfolioCategory',
            'slug' => 'app.portfolio.categories.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPortfolioCategory->id,
            'name' => 'Delete PortfolioCategory',
            'slug' => 'app.portfolio.categories.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPortfolioCategory->id,
            'name' => 'Approve PortfolioCategory',
            'slug' => 'app.portfolio.categories.approve'
        ]);


        $moduleAppPortfolioPost = Module::updateOrCreate(['name' => 'Portfolio-Post Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppPortfolioPost->id,
            'name' => 'View (Global)',
            'slug' => 'app.portfolio.posts.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPortfolioPost->id,
            'name' => 'View (Self)',
            'slug' => 'app.portfolio.posts.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPortfolioPost->id,
            'name' => 'Create PortfolioPost',
            'slug' => 'app.portfolio.posts.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPortfolioPost->id,
            'name' => 'Edit PortfolioPost',
            'slug' => 'app.portfolio.posts.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPortfolioPost->id,
            'name' => 'Delete PortfolioPost',
            'slug' => 'app.portfolio.posts.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPortfolioPost->id,
            'name' => 'Approve PortfolioPost',
            'slug' => 'app.portfolio.posts.status'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPortfolioPost->id,
            'name' => 'Approve PortfolioPost',
            'slug' => 'app.portfolio.posts.approve'
        ]);


        $moduleAppPriceCategory = Module::updateOrCreate(['name' => 'Price-Category Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppPriceCategory->id,
            'name' => 'View (Global)',
            'slug' => 'app.price.categories.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPriceCategory->id,
            'name' => 'View (Self)',
            'slug' => 'app.price.categories.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPriceCategory->id,
            'name' => 'Create PriceCategory',
            'slug' => 'app.price.categories.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPriceCategory->id,
            'name' => 'Edit PriceCategory',
            'slug' => 'app.price.categories.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPriceCategory->id,
            'name' => 'Delete PriceCategory',
            'slug' => 'app.price.categories.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPriceCategory->id,
            'name' => 'Approve PriceCategory',
            'slug' => 'app.price.categories.approve'
        ]);


        $moduleAppPricePost = Module::updateOrCreate(['name' => 'Price-Post Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppPricePost->id,
            'name' => 'View (Global)',
            'slug' => 'app.price.posts.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPricePost->id,
            'name' => 'View (Self)',
            'slug' => 'app.price.posts.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPricePost->id,
            'name' => 'Create PricePost',
            'slug' => 'app.price.posts.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPricePost->id,
            'name' => 'Edit PricePost',
            'slug' => 'app.price.posts.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPricePost->id,
            'name' => 'Delete PricePost',
            'slug' => 'app.price.posts.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPricePost->id,
            'name' => 'Approve PricePost',
            'slug' => 'app.price.posts.status'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPricePost->id,
            'name' => 'Approve PricePost',
            'slug' => 'app.price.posts.approve'
        ]);


        $moduleAppcustompage = Module::updateOrCreate(['name' => 'Custom-Page Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleAppcustompage->id,
            'name' => 'View (Global)',
            'slug' => 'app.custom.pages.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppcustompage->id,
            'name' => 'View (Self)',
            'slug' => 'app.custom.pages.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppcustompage->id,
            'name' => 'Create Custompage',
            'slug' => 'app.custom.pages.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppcustompage->id,
            'name' => 'Edit Custompage',
            'slug' => 'app.custom.pages.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppcustompage->id,
            'name' => 'Delete Custompage',
            'slug' => 'app.custom.pages.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppcustompage->id,
            'name' => 'Approve Custompage',
            'slug' => 'app.custom.pages.status'
        ]);


        $moduleApppagebuilder = Module::updateOrCreate(['name' => 'Widget Management']);

        Permission::updateOrCreate([
            'module_id' => $moduleApppagebuilder->id,
            'name' => 'View (Global)',
            'slug' => 'app.build.pages.global'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleApppagebuilder->id,
            'name' => 'View (Self)',
            'slug' => 'app.build.pages.self'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleApppagebuilder->id,
            'name' => 'Create Pagebuilder',
            'slug' => 'app.build.pages.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleApppagebuilder->id,
            'name' => 'Edit Pagebuilder',
            'slug' => 'app.build.pages.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleApppagebuilder->id,
            'name' => 'Delete Pagebuilder',
            'slug' => 'app.build.pages.destroy'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleApppagebuilder->id,
            'name' => 'Pagebuilder',
            'slug' => 'app.build.pages.pagebuilder'
        ]);

    }
}
