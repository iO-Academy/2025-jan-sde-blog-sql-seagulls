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

            $actual = PostDisplayService::displayAllPosts([$input]);
            $this->assertStringContainsString($input->title, $actual);
            $this->assertStringContainsString($input->username, $actual);
            $this->assertStringContainsString($input->content, $actual);
            $this->assertStringContainsString($input->date_posted, $actual);
            $this->assertStringContainsString($input->id, $actual);
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

            $actual = PostDisplayService::displayAllPosts([$input]);
            $this->assertStringContainsString($input->title, $actual);
            $this->assertStringContainsString($input->username, $actual);
            $this->assertStringContainsString('TestContent, TestContent, TestContent, TestContent, TestContent, TestContent, TestContent, TestConte...', $actual);
            $this->assertStringContainsString($input->date_posted, $actual);
            $this->assertStringContainsString($input->id, $actual);
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

            $actual = PostDisplayService::displaySingle($input);
            $this->assertStringContainsString($input->title, $actual);
            $this->assertStringContainsString($input->username, $actual);
            $this->assertStringContainsString($input->content, $actual);
            $this->assertStringContainsString($input->date_posted, $actual);
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


            $actual = PostDisplayService::displaySingle($input);
            $this->assertStringContainsString($input->title, $actual);
            $this->assertStringContainsString('Anonymous', $actual);
            $this->assertStringContainsString($input->content, $actual);
            $this->assertStringContainsString($input->date_posted, $actual);
        }

}