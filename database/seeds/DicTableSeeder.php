<?php

use Illuminate\Database\Seeder;

class DicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            "私募基金牌照",
            "公募基金牌照",
            "基金销售牌照",
            "基金子公司牌照",
            "信托牌照",
            "第三方支付牌照",
            "期货牌照",
            "保险牌照",
            "融资租赁牌照",
            "商业保理牌照",
            "小额贷款牌照",
            "典当牌照",
            "外汇交易牌照",
            "其他",
        ];

        $regions = ["上海"];

        foreach ($categories as $category) {
            DB::table('categories')->insert(['name' => $category]);
        }

        foreach ($regions as $region) {
            DB::table('regions')->insert(['name' => $region]);
        }
    }
}
