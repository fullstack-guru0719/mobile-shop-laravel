<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageMetaTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Landing Page
        DB::table('pagebuilder__meta_tags')->truncate();
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'title', 'meta_type' => 'name', 'page_id' => 1, 'content' => 'Sell used Cell Phones, Game Consoles and Electronics. Get Paid!', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'description', 'meta_type' => 'name', 'page_id' => 1, 'content' => 'Need fast cash? Sell us your Apple iPhone XS Max. We pay better than anyone else on the Internet. We research our competitors prices.', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:type', 'meta_type' => 'property', 'page_id' => 1, 'content' => 'website', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:url', 'meta_type' => 'property', 'page_id' => 1, 'content' => url('/'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:title', 'meta_type' => 'property', 'page_id' => 1, 'content' => 'Sell used Cell Phones, Game Consoles and Electronics. Get Paid!', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:description', 'meta_type' => 'property', 'page_id' => 1, 'content' => 'Need fast cash? Sell us your Apple iPhone XS Max. We pay better than anyone else on the Internet. We research our competitors prices.', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:image', 'meta_type' => 'property', 'page_id' => 1, 'content' => url('/assets/images/logo-white.png'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:url', 'meta_type' => 'name', 'page_id' => 1, 'content' => url('/'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:title', 'meta_type' => 'name', 'page_id' => 1, 'content' => 'Sell used Cell Phones, Game Consoles and Electronics. Get Paid!', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:description', 'meta_type' => 'name', 'page_id' => 1, 'content' => 'Need fast cash? Sell us your Apple iPhone XS Max. We pay better than anyone else on the Internet. We research our competitors prices.', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:image', 'meta_type' => 'name', 'page_id' => 1, 'content' => url('/assets/images/logo-white.png'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'keywords', 'meta_type' => 'name', 'page_id' => 1, 'content' => 'Tronics Pay', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        // Contact Us
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'title', 'meta_type' => 'name', 'page_id' => 2, 'content' => 'Contact Us - Tronics Pay', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'description', 'meta_type' => 'name', 'page_id' => 2, 'content' => 'TronicsPay.com - Sell your Smartphones for CASH.  You\'re guaranteed the highest offers, free shipping, and SAME-DAY payment.  100% satisfaction is guaranteed, or we will return your phone at no cost.', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:type', 'meta_type' => 'property', 'page_id' => 2, 'content' => 'article', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:url', 'meta_type' => 'property', 'page_id' => 2, 'content' => url('/contact-us'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:title', 'meta_type' => 'property', 'page_id' => 2, 'content' => 'Contact Us - Tronics Pay', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:description', 'meta_type' => 'property', 'page_id' => 2, 'content' => 'TronicsPay.com - Sell your Smartphones for CASH.  You\'re guaranteed the highest offers, free shipping, and SAME-DAY payment.  100% satisfaction is guaranteed, or we will return your phone at no cost.', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:image', 'meta_type' => 'property', 'page_id' => 2, 'content' => url('/assets/images/logo-white.png'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:url', 'meta_type' => 'name', 'page_id' => 2, 'content' => url('/contact-us'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:title', 'meta_type' => 'name', 'page_id' => 2, 'content' => 'Contact Us - Tronics Pay', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:description', 'meta_type' => 'name', 'page_id' => 2, 'content' => 'TronicsPay.com - Sell your Smartphones for CASH.  You\'re guaranteed the highest offers, free shipping, and SAME-DAY payment.  100% satisfaction is guaranteed, or we will return your phone at no cost.', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:image', 'meta_type' => 'name', 'page_id' => 2, 'content' => url('/assets/images/logo-white.png'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'keywords', 'meta_type' => 'name', 'page_id' => 2, 'content' => 'Tronics Pay,Contact Us', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);

        // How it works
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'title', 'meta_type' => 'name', 'page_id' => 3, 'content' => 'How it works - Tronics Pay', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'description', 'meta_type' => 'name', 'page_id' => 3, 'content' => 'Step 1 Get an Instant Offer Tell us a little bit about your phone and we’ll make an offer right away! We have a highest price guarantee &amp; there are no obligations. GET A QUOTE NOW Step 2 Ship Your Phone Shipping is 100% free. We’ll send you a prepaid shipping label via email. Simply', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:type', 'meta_type' => 'property', 'page_id' => 3, 'content' => 'article', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:url', 'meta_type' => 'property', 'page_id' => 3, 'content' => url('/how-it-works'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:title', 'meta_type' => 'property', 'page_id' => 3, 'content' => 'How it works - Tronics Pay', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:description', 'meta_type' => 'property', 'page_id' => 3, 'content' => 'Step 1 Get an Instant Offer Tell us a little bit about your phone and we’ll make an offer right away! We have a highest price guarantee &amp; there are no obligations. GET A QUOTE NOW Step 2 Ship Your Phone Shipping is 100% free. We’ll send you a prepaid shipping label via email. Simply', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:image', 'meta_type' => 'property', 'page_id' => 3, 'content' => url('/assets/images/logo-white.png'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:url', 'meta_type' => 'name', 'page_id' => 3, 'content' => url('/how-it-works'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:title', 'meta_type' => 'name', 'page_id' => 3, 'content' => 'How it works - Tronics Pay', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:description', 'meta_type' => 'name', 'page_id' => 3, 'content' => 'Step 1 Get an Instant Offer Tell us a little bit about your phone and we’ll make an offer right away! We have a highest price guarantee &amp; there are no obligations. GET A QUOTE NOW Step 2 Ship Your Phone Shipping is 100% free. We’ll send you a prepaid shipping label via email. Simply', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:image', 'meta_type' => 'name', 'page_id' => 3, 'content' => url('/assets/images/logo-white.png'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'keywords', 'meta_type' => 'name', 'page_id' => 3, 'content' => 'Tronics Pay,How it works', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);

        // About Us
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'title', 'meta_type' => 'name', 'page_id' => 6, 'content' => 'About us - Tronics Pay', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'description', 'meta_type' => 'name', 'page_id' => 6, 'content' => 'At TronicsPay, our mission is to transform the way consumers recycle their used cell phones.  Whether it’s selling an old phone or raising money through charitable fundraising, we guarantee satisfaction by providing a fast, easy, and secure portal to sell your mobile phones.  We offer fast payment options, provide free shipping, and ensure competitive prices.', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:type', 'meta_type' => 'property', 'page_id' => 6, 'content' => 'article', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:url', 'meta_type' => 'property', 'page_id' => 6, 'content' => url('/about-us'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:title', 'meta_type' => 'property', 'page_id' => 6, 'content' => 'About us - Tronics Pay', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:description', 'meta_type' => 'property', 'page_id' => 6, 'content' => 'At TronicsPay, our mission is to transform the way consumers recycle their used cell phones.  Whether it’s selling an old phone or raising money through charitable fundraising, we guarantee satisfaction by providing a fast, easy, and secure portal to sell your mobile phones.  We offer fast payment options, provide free shipping, and ensure competitive prices.', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'og:image', 'meta_type' => 'property', 'page_id' => 6, 'content' => url('/assets/images/logo-white.png'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:url', 'meta_type' => 'name', 'page_id' => 6, 'content' => url('/about-us'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:title', 'meta_type' => 'name', 'page_id' => 6, 'content' => 'About us - Tronics Pay', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:description', 'meta_type' => 'name', 'page_id' => 6, 'content' => 'At TronicsPay, our mission is to transform the way consumers recycle their used cell phones.  Whether it’s selling an old phone or raising money through charitable fundraising, we guarantee satisfaction by providing a fast, easy, and secure portal to sell your mobile phones.  We offer fast payment options, provide free shipping, and ensure competitive prices.', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'twitter:image', 'meta_type' => 'name', 'page_id' => 6, 'content' => url('/assets/images/logo-white.png'), 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('pagebuilder__meta_tags')->insert(['name' => 'keywords', 'meta_type' => 'name', 'page_id' => 6, 'content' => 'Tronics Pay,About Us', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
    }
}
