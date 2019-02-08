<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */
class Welcome_test extends NsemiControllerAbstractTest
{
    
    /**
     * Creates a Welcome controller test case.
     */
    public function __construct() {
        parent::__construct('welcome');
    }
    
    public function testHasWelcomeTitle() {
        // Calls welcome/index...
        $output = $this->request('GET', 'welcome');
        $expected = 'Welcome to Nsemi';
        
        // Asserts on title existence
        $this->assertContains($expected, $output);
    }
    
    
    public function testHasWelcomeSubtitle() {
        // Calls welcome/index...
        $output = $this->request('GET', 'welcome');
        $expected = 'Image Transformation Tool for Image Lovers';

        // Asserts on subtitle existence
        $this->assertContains($expected, $output);
    }
    
    public function testHasWelcomeActions() {
        // Calls welcome/index...
        $output = $this->request('GET', 'welcome');
        $expected1 = 'Search Gallery, Upload and  Monetize your Images';
        $expected2 = 'Resize images, Create thumbnails and Convert images';
        $expected3 = 'Easy to Use: Watch the Video Guides';

        // Asserts on subtitle existence
        $this->assertContains($expected1, $output);
        $this->assertContains($expected2, $output);
        $this->assertContains($expected3, $output);
    }
}
