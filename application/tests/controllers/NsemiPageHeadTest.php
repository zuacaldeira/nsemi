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


class NsemiPageHeadTest extends TestCase {
    //put your code here
    
    /**
     * Test that a page have the charset metatag set.
     * @test
     * @param string $page The page we are testing
     * @dataProvider pageProvider
     */
    public function testPageHeadHasCharset($page) {
        $output = $this->request('GET', $page);
        $this->assertContains('<meta charset="utf-8">', $output);
    }
    
    /**
     * Test that a page have the title meta tag set.
     * @test
     * @param string $page The page we are testing.
     * @dataProvider pageProvider
     */
    public function testPageHeadHasTitle($page) {
        $output = $this->request('GET', $page);
        $this->assertContains('<title>Nsemi Image Processing</title>', $output);
        $this->assertContains('<meta name="viewport" content="width=device-width, initial-scale=1">', $output);        
    }
    
    /**
     * Test that a page have the title meta tag set. Session variable 'username'
     * is required to be in session.
     * 
     * @test
     * @param string $page The page we are testing.
     * @dataProvider pageProvider
     */
    public function testPageWithSessionUserHeadHasTitle($page) {
        $this->request->setCallable(
            function($CI) {
                $CI->session->username = 'zuacaldeira';
            }
        );
        
        // Check session variable is set
        
        // Test page test as before
        $this->testPageHeadHasTitle($page);
    }
 
    /**
     * Test that a page have the viewport meta tag set.
     * @test
     * @param string $page The page we are testing.
     * @dataProvider pageProvider
     */
    public function testPageHeadHasViewport($page) {
        $output = $this->request('GET', $page);
        $this->assertContains('<meta name="viewport" content="width=device-width, initial-scale=1">', $output);        
    }

    /**
     * Data provider of routes.
     * @return array[name => route]
     */
    public function pageProvider() {
        return [
            'welcome_index'  => ['welcome/index'],
            'gallery_index'  => ['gallery/index'],
            'tools_index'    => ['tools/index'],
            'vguides_index'  => ['vguides/index'],
            'register_index' => ['register/index'],
            'login_index'    => ['login/index'],
            //'logout_index'   => ['logout'] -- needs session data set
            //'migrate_index'    => ['migrate'], -- needs migration library
        ];
    }    
}
