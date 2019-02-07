<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NsemiControllerTestCase
 *
 * @author CC-Student
 */


class NsemiController_test extends TestCase {
    //put your code here
    
    /**
     * Test that index pages have all required meta tags.
     * @test
     * @param string $page controller/index values for each
     * @dataProvider indexPageProvider
     */
    public function testPageHead($page) {
        $output = $this->request('GET', $page);
        $this->assertContains('<meta charset="utf-8">', $output);
    }
    /**
     * Test that all controllers have title and common meta tags set.
     * @test
     * @dataProvider indexPageProvider
     */
    public function testIndexMethod($page) {
        $output = $this->request('GET', $page);
        $this->assertContains('<title>Nsemi Image Processing</title>', $output);
    }
    
    public function indexPageProvider() {
        return [
            'welcome_index' => ['welcome/index'],
            'gallery_index' => ['gallery/index'],
            'tools_index'   => ['tools/index'],
            'vguides_index' => ['vguides/index']
        ];
    }
    
    /**
     * Test that header has viewport tag set.
     * @test
    public function testViewport() {
        
    }
     */
    
}
