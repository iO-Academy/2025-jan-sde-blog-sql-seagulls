<?php

require_once 'src/services/PostValidationService.php';

use PHPUnit\Framework\TestCase;

class PostValidationServiceTest extends TestCase
{
    public function test_TitleValidationTrue(): void
    {
        $input = 'Test';

        $actual = PostValidationService::TitleValidation($input);
        $this->assertTrue($actual);
    }

    public function test_TitleValidationFalseEmpty(): void
    {
        $input = '';

        $actual = PostValidationService::TitleValidation($input);
        $this->assertFalse($actual);
    }

    public function test_TitleValidationFalseLong(): void
    {
        $input = 'Test Test Test Test Test Test T';

        $actual = PostValidationService::TitleValidation($input);
        $this->assertFalse($actual);
    }

    public function test_ContentValidationTrue(): void
    {
        $input = 'Test Test Test Test Test Test Test Test Test Test Test Test ';
        $actual = PostValidationService::ContentValidation($input);
        $this->assertTrue($actual);
    }

    public function test_ContentValidationShort(): void
    {
        $input = 'Test';
        $actual = PostValidationService::ContentValidation($input);
        $this->assertFalse($actual);
    }

    public function test_ContentValidationLong(): void
    {
        $input = "In the vast expanse of the universe, where stars are born in the depths of nebulae and galaxies spiral through the void like cosmic dancers, humanity stands at the threshold of discovery. For centuries, we've gazed upward, wondering about the mysteries of the cosmos. What lies beyond the reaches of our solar system? What forces govern the behavior of distant stars and planets? As technology advances, we inch closer to answers, yet still, there is so much left to learn. Every new discovery opens the door to even more questions. From the study of black holes and quantum mechanics to the search for extraterrestrial life, science has propelled us into an era of unprecedented exploration. We now possess the tools to peer deeper into the universe than ever before, using powerful telescopes and sophisticated space probes to gather data that once seemed out of reach. But while we continue our outward journey into space, we must also turn inward, understanding more about our own planet, its ecosystems, and the delicate balance that sustains life. The quest for knowledge is not merely about uncovering the unknown; it’s about ensuring a future where we can thrive as a species while also preserving the beauty and resources of our home. The path forward is filled with challenges, but it is a path worth walking, for in the pursuit of knowledge, we find not only answers, but a greater understanding of who we are and where we are headed.";
        $actual = PostValidationService::ContentValidation($input);
        $this->assertFalse($actual);
    }
}