<?php

class PostSeeder extends DatabaseSeeder {

    public function run()
    {

        $post = array(
                            array(
                                'title' => 'title1',
                                'summary' => 'this is a summary',
                                'content' => 'content 1 content.....',
                                'is18'=>'1'
                                )
                        );

        foreach ($posts as $post) {
            DB::table('posts')->insert($posts);
        }

    }

}