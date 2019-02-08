<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NsemiControllerAbstractTest
 *
 * @author CC-Student
 */
abstract class NsemiControllerAbstractTest extends TestCase {
    
        private $controller;
        
        public function __construct($name) {
            parent::__construct();
            $this->controller = $name;
        }
    
        //put your code here
	public function test_index()
	{
		$output = $this->request('GET', $this->controller.'/index');
		$this->assertContains('<title>Nsemi Image Processing</title>', $output);
	}

	public function test_method_404()
	{
		$this->request('GET', $this->controller.'/method_not_exist');
		$this->assertResponseCode(404);
	}

        /**
         * @test
         */
	public function test_APPPATH()
	{
		$actual = realpath(APPPATH);
		$expected = realpath(__DIR__ . '/../..');
		$this->assertEquals(
			$expected,
			$actual,
			'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
		);
	}
}
