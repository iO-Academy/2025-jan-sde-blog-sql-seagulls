<?php

require_once 'src/services/PostDisplayService.php';
require_once 'src/entities/PostEntity.php';

use PHPUnit\Framework\TestCase;

    class PostDisplayServiceTest extends TestCase
    {
        public function test_PostDisplayService_shortContent(): void
        {
            $input = new PostEntity();

            $input->id = 2;
            $input->title = 'Test';
            $input->username = 'TestName';
            $input->content = 'TestContent';
            $input->date_posted = "2025-02-01";
            $input->time_posted = "15:22:00";

            $expected = '<article class="p-8 border border-solid rounded-md">';
            $expected .= '<div class="flex justify-between items-center flex-col md:flex-row mb-4">';
            $expected .= "<h2 class='text-4xl'>Test</h2>";
            $expected .= '</div>';
            $expected .= "<p class='text-2xl mb-2'>2025-02-01 - TestName</p>";
            $expected .= "<p>TestContent</p>";
            $expected .= '<div class="flex justify-center">';
            $expected .= "<a class='px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm' href='singlePost.php?id=2'>View post</a>";
            $expected .= '</div>';
            $expected .= '</article>';

            $actual = PostDisplayService::displayAllPosts([$input]);
            $this->assertEquals($expected, $actual);
        }

        public function test_PostDisplayService_longContent(): void
        {
            $input = new PostEntity();

            $input->id = 2;
            $input->title = 'Test';
            $input->username = 'TestName';
            $input->content = 'TestContent, TestContent, TestContent, TestContent, TestContent, TestContent, TestContent, TestContent, TestContent, TestContent, TestContent, TestContent';
            $input->date_posted = "2025-02-01";
            $input->time_posted = "15:22:00";

            $expected = '<article class="p-8 border border-solid rounded-md">';
            $expected .= '<div class="flex justify-between items-center flex-col md:flex-row mb-4">';
            $expected .= "<h2 class='text-4xl'>Test</h2>";
            $expected .= '</div>';
            $expected .= "<p class='text-2xl mb-2'>2025-02-01 - TestName</p>";
            $expected .= "<p>TestContent, TestContent, TestContent, TestContent, TestContent, TestContent, TestContent, TestConte...</p>";
            $expected .= '<div class="flex justify-center">';
            $expected .= "<a class='px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm' href='singlePost.php?id=2'>View post</a>";
            $expected .= '</div>';
            $expected .= '</article>';

            $actual = PostDisplayService::displayAllPosts([$input]);
            $this->assertEquals($expected, $actual);
        }

        public function test_PostDisplayService_noContent(): void
        {
            $expected = "<p class='text-2xl mb-2'>No posts found</p>";

            $actual = PostDisplayService::displayAllPosts([]);
            $this->assertEquals($expected, $actual);
        }

        public function test_PostDisplayService_singlePostWithUser(): void
        {
            $input = new PostEntity();
            $input->id = 2;
            $input->title = 'Test';
            $input->username = 'TestName';
            $input->content = 'TestContent';
            $input->date_posted = "2025-02-01";
            $input->time_posted = "15:22:00";

            $expected = '<div class="flex justify-between items-center flex-col md:flex-row mb-4">';
            $expected .= "<h2 class='text-4xl'>Test</h2>";
            $expected .= '</div>';
            $expected .=  "<p class='text-2xl mb-10'>2025-02-01 - TestName</p>";
            $expected .=  "<p>TestContent</p>";
            $expected .=  '<div class="flex justify-center">';
            $expected .= '<a class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm" href="index.php">View all posts</a>';
            $expected .= '</div>';

            $actual = PostDisplayService::displaySingle($input);
            $this->assertEquals($expected, $actual);
        }

        public function test_PostDisplayService_singlePostWithoutUser(): void
        {
            $input = new PostEntity();
            $input->id = 2;
            $input->title = 'Test';
            $input->username = '';
            $input->content = 'TestContent';
            $input->date_posted = "2025-02-01";
            $input->time_posted = "15:22:00";

            $expected = '<div class="flex justify-between items-center flex-col md:flex-row mb-4">';
            $expected .= "<h2 class='text-4xl'>Test</h2>";
            $expected .= '</div>';
            $expected .=  "<p class='text-2xl mb-10'>2025-02-01 - Anonymous</p>";
            $expected .=  "<p>TestContent</p>";
            $expected .=  '<div class="flex justify-center">';
            $expected .= '<a class="px-3 py-2 mt-4 text-lg bg-indigo-400 hover:bg-indigo-700 hover:text-white transition inline-block rounded-sm" href="index.php">View all posts</a>';
            $expected .= '</div>';

            $actual = PostDisplayService::displaySingle($input);
            $this->assertEquals($expected, $actual);
        }

}