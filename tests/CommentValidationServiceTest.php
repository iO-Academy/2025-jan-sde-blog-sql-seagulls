<?php

require_once 'src/services/CommentValidationService.php';
require_once 'src/entities/CommentEntity.php';

use PHPUnit\Framework\TestCase;

class CommentValidationServiceTest extends TestCase
{
    public function test_CommentValidation(): void
    {
        $input = "seagulls are awesome";

        $actual = CommentValidationService::ContentValidation($input);
        $this->assertTrue($actual);
    }

    public function test_CommentValidation_toShort(): void
    {
        $input = "seagulls";

        $actual = CommentValidationService::ContentValidation($input);
        $this->assertFalse($actual);
    }

    public function test_CommentValidation_toLong(): void
    {
        $input = "seagulls are awesome seagulls are awesome seagulls are awesome seagulls are awesome seagulls are awesome seagulls are awesome seagulls are awesome seagulls are awesome seagulls are awesome seagulls are awesome seagulls are awesome";

        $actual = CommentValidationService::ContentValidation($input);
        $this->assertFalse($actual);
    }
}