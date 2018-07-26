<?php

use Illuminate\Database\Seeder;

use App\Category;
use App\Brand;
use App\Product;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->categories();
        $this->brands();
        $this->products();
    }

    public function categories(){
        $path = base_path().'\database\seeds\files\categories.csv';
        $file = fopen($path, "r");

        $categories = [];

        while(($line = fgetcsv($file, ',')) !== false){
            //Structure : name; descrption
            if (trim($line[0]) !== ''){
                $name = trim($line[0]);
                $description = trim($line[1]);

                $category = [
                    'name' => $name,
                    'description' => $description
                ];
                array_push($categories, $category);
            }            
        }

        DB::table('categories')->insert($categories);
        fclose($file);
    }

    public function brands(){
        $path = base_path().'\database\seeds\files\brands.csv';
        $file = fopen($path, "r");

        $brands = [];

        while(($line = fgetcsv($file, ',')) !== false){
            //Structure : name; descrption
            if (trim($line[0]) !== ''){
                $name = trim($line[0]);
                $description = trim($line[1]);

                $brand = [
                    'name' => $name,
                    'description' => $description
                ];
                array_push($brands, $brand);
            }            
        }

        DB::table('brands')->insert($brands);
        fclose($file);
    }

    public function products(){
        $path = base_path().'\database\seeds\files\products.csv';
        $file = fopen($path, "r");

        $products = [];
        $categories = Category::all();
        $brands = Brand::all();

        //var_dump($brands);

        while(($line = fgetcsv($file, ',')) !== false){
            //Structure : name, descrption, score, price, category name, brand name
            if (trim($line[0]) !== ''){
                $name           = trim($line[0]);
                $description    = trim($line[1]);
                $score          = trim($line[2]);
                $price          = trim($line[3]);

                //$category = $this->findItem($categories, $line[4]);
                $category = $categories->where('name', '=', trim($line[4]))->first();
                $brand = $brands->where('name', '=', trim($line[5]))->first();

                $brand = [
                    'name' => $name,
                    'description' => $description,
                    'score'       => $score,
                    'price'       => $price,
                    'category_id' => $category == null ? null : $category->id,
                    'brand_id'    => $brand == null ? null : $brand->id

                ];
                array_push($products, $brand);
            }            
        }

        DB::table('products')->insert($products);
        fclose($file);
    }

    public function findItem($array, $itemName){
        foreach($array as $object){
            if($object->name == $itemName)
                return $object;
        }
        return null;
    }
}
