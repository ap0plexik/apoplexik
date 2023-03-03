<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use \App\Models\Category;
use \App\Models\Post;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		if ('local' !== env('APP_ENV')) {
			return;
		}

		User::create([
			'name'     => 'Admin',
			'email'    => 'admin@local.test',
			'password' => bcrypt('password'),
		]);

		$i = 1;
		$categories = [
			'Category 1',
			'Category 2',
			'Category 3',
		];
		foreach($categories as $category) {
			Category::create([
				'name' => $category,
				'cat_order' => $i,
			]);
			$i++;
		}


		for( $i = 0; $i < 10; $i++ ) {
			$title = Str::random(10);
			$content_length = rand(300, 1000);
			Post::create([
				'title' => $title,
				'body' => substr(chunk_split(Str::random($content_length), 4, ' '), 0, $content_length),
				'slug' => Str::slug($title),
			]);
		}
	}
}
