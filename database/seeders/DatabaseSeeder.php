<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Menu;
use App\Models\Page;
use App\Models\Footer;
use App\Models\Header;
use App\Models\Message;
use App\Models\MenuItem;
use App\Models\PageSetting;
use App\Models\ContactSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\Role;
use Laravel\Jetstream\Rules\Role as RulesRole;
use Spatie\Permission\Models\Role as ModelsRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       

        Page::create([
            'title' => 'Home',
            'slug' => 'home',
            'content' => '<h1 style="text-align: center; line-height: 2;">Welcome to Dosta CMS</h1>
            <p style="text-align: center; line-height: 2;">Effortlessly manage your content with Dosta CMS &ndash; the straightforward, fast solution designed to streamline your digital presence.</p>',
            'published' => '1'
        ]);
        Page::create([
            'title' => 'Contacts',
            'slug' => 'contacts',
            'content' => '',
            'published' => '1'
        ]);

    Menu::create([
        'name' => 'Main_menu',
        'location' => 'top'
    ]);
    MenuItem::create([
        'menu_id' => '1',
        'title' => 'Home',
        'url' => 'http://127.0.0.1:8000/home',
        'order' => '1'
    ]);
    MenuItem::create([
        'menu_id' => '1',
        'title' => 'Conctact us',
        'url' => 'http://127.0.0.1:8000/contacts',
        'order' => '2'
    ]);
    Header::create([
        'show_header' => '1',
        'header_image' => 'header/0wtouRlGNaAC78XKFpKAiswMmX7JU2iSKn8wVwjT.jpg'
    ]);
    Footer::create([
        'show_footer' => '1',
        'footer_text' => '<div class="container">&nbsp;</div>
        <div class="container">
        <p class="text-center footer-text py-4" style="text-align: center;">&copy; 2023 Dosta CMS. All rights reserved.</p>
        </div>',     
    ]);
    Message::create([
        'name' => 'test',
        'email' => 'test@gmail.com',
        'title' => 'test',
        'message' => 'test'
    ]);
    ContactSetting::create([
        'recipient_email' => 'test@gmail.com',
        'recipient_name' => 'test',
        'slug' => 'contacts'
    ]);
    PageSetting::create([
        'title' => 'Dosta CMS',
        'icon' => 'public/icons/OMRSpz1Gla0eHOqHwBExmg4cOGKzFR7IsPwhHW2E.jpg',
        'description' => 'Dosta CMS'
    ]);

    ModelsRole::create([
        'name' => 'admin',
        'guard_name' => 'web'
    ]);
    ModelsRole::create([
        'name' => 'moderator',
        'guard_name' => 'web'
    ]);
    ModelsRole::create([
        'name' => 'member',
        'guard_name' => 'web'
    ]);


    $pivotData = [
        ['menu_id' => 1, 'page_id' => 1],
        ['menu_id' => 1, 'page_id' => 2],
    ];

    $this->call([
        UserSeeder::class
    ]);

    DB::table('menu_page')->insert($pivotData);
    }
}
