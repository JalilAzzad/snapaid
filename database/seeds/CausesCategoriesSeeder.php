<?php

use Illuminate\Database\Seeder;
use App\CausesCategory;

class CausesCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            "Charity" => [
                "Red Cross", "St Jude"
            ],
            "Tuition" => [
                "College Tuition", "School Tuition"
            ],
            "Fund Raising" => [
                "School", "Technology"
            ],
        ];
        foreach ($categories as $category => $causes)
        {
            $ca = new CausesCategory();
            $ca->title = $category;
            $ca->slug = str_slug($category);
            $ca->save();

            foreach ($causes as $c)
            {
                $cause = new \App\Cause();
                $cause->category_id = $ca->id;
                $cause->title = $c;
                $cause->slug = str_slug($c);
                $cause->save();
            }

        }
    }
}
