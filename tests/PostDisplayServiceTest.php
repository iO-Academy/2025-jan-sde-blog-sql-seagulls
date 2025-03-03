<?php

require_once 'src/services/PostDisplayService.php';
require_once 'src/entities/PostEntity.php';

use PHPUnit\Framework\TestCase;

    class PostDisplayServiceTest extends TestCase
    {
        public function test_PostDisplayService_output(): void
        {
            $input = new PostEntity();

            $input->id = 2;
            $input->title = 'Test';
            $input->username = 'TestName';
            $input->content = 'TestContent';
            $input->date_posted = "2025-02-01";
            $input->time_posted = "15:22:00";

            $expected = "
            <article class="p-8 border border-solid rounded-md">
            <span class='px-3 py-2 bg bg-slate-200 inline-block mb-4 rounded-sm'>CATEGORY HERE</span>
            <div class="flex justify-between items-center flex-col md:flex-row mb-4">
            <h2 class='text-4xl'>Test</h2>
            <span class='text-xl'>LIKES & DISLIKES HERE</span>
            </div>
            <p class='text-2xl mb-2'>2025-02-01 - TestName</p>
            <p>TestContent</p>
            </article>";"

            $actual = PostDisplayService::displayAllPosts($input);
            $this->assertEquals($expected, $actual);

        }


}