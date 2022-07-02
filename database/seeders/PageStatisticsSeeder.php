<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PageStatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page_statics')->truncate();
        DB::table('page_statics')->insert(['page_id' => 2, 'content' => '{\"image1\":\"uploads\\/pages\\/static\\/image-1_20201206065440.jpg\",\"image2\":\"uploads\\/pages\\/static\\/image-2_20201206060230.jpg\",\"image3\":\"uploads\\/pages\\/static\\/image-3_20201206060230.jpg\",\"header_2\":\"About Us\",\"text_2\":\"At TronicsPay, our mission is to transform the way consumers recycle their used cell phones.  We guarantee satisfaction by providing a fast, easy, and secure portal to sell your mobile phones. We offer fast payment options, provide free shipping, and ensure competitive prices.\",\"header_3\":\"Charities\",\"text_3\":\"That\'s not all.  We help businesses thrive by purchasing retired fleets of phones, raise funds for charitable causes, and facilitate recycling to reduce.\",\"header_4\":\"E-Waste\",\"text_4\":\"We truly believe the responsible alternative to tossing your mobile phones is one that serves the environment, your community, and your wallet. Even if your old device is non-functioning, we still will accept and recycle on your behalf!\",\"social\":{\"text\":\"Connect With Us On Social Media!\",\"facebook\":\"https:\\/\\/facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\\/\",\"instagram\":\"https:\\/\\/instagram.com\\/\",\"youtube\":\"https:\\/\\/youtube.com\\/\"}}', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('page_statics')->insert(['page_id' => 4, 'content' => '{\"google_map\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d3097.2195538694464!2d-94.41648289308372!3d39.07869647373669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87c0fdf2628895ff%3A0x74b538aa176b05bc!2sTronics%20Pay!5e0!3m2!1sen!2sph!4v1605701145623!5m2!1sen!2sph\",\"header\":null,\"image\":\"uploads\\/pages\\/static\\/image-1_20201206074846.jpeg\",\"schedule\":\"10:00AM - 7:00PM<br \\/> Monday - Saturday<br \\/>12:00PM - 5:00PM<br \\/>Sunday\",\"location\":\"1214 S Noland Rd, Independence, MO 64055\",\"contact\":\"1-816-886-7285\",\"email\":\"tronicspay@gmail.com\"}', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
        DB::table('page_statics')->insert(['page_id' => 1, 'content' => '{\"header1\":\"Send In Your Mobile Device & Get Paid.\",\"image1\":\"uploads\\/pages\\/static\\/bg-2_20201206114638.jpg\",\"image2\":\"uploads\\/pages\\/static\\/bg-3_20201206114638.jpg\",\"header2\":\"SELLING YOUR PHONE.\",\"sub_header\":\"How It Works\",\"text1\":\"Step 1 - Get an Instant Offer.\",\"content1\":\"Tell us a little bit about your phone and we\\u2019ll make an offer right away! We have a highest price guarantee & there are no obligations.\",\"text2\":\"Step 2 - Ship Your Phone.\",\"content2\":\"Shipping is 100% free. We\\u2019ll send you a prepaid shipping label via email. Simply print the label and place it on a box or padded envelope.\",\"text3\":\"Step 3 - Get Paid.\",\"content3\":\"Once we receive your order, it\\u2019s time for you to cash in! Tronics Pay offers the highest payouts, 30-day price locks, and speedy payments.\",\"text4\":\"Speedy Payment Options.\",\"content4\":\"Choose the payment method that works best for you. We can send you a check in the mail or send your payment directly to your PayPal account.\",\"card1h\":\"Step 1\",\"card1t\":\"INPUT DEVICE INFO\",\"card2h\":\"Step 2\",\"card2t\":\"GET SHIPPING LABEL\",\"card3h\":\"Step 3\",\"card3t\":\"GET PAID!\",\"google_map\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d3097.2195538694464!2d-94.41648289308372!3d39.07869647373669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87c0fdf2628895ff%3A0x74b538aa176b05bc!2sTronics%20Pay!5e0!3m2!1sen!2sph!4v1605701145623!5m2!1sen!2sph\"}', 'created_at' => '2020-12-07 07:49:20', 'updated_at' => '2020-12-07 07:49:20']);
    }
}
