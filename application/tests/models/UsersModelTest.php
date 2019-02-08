<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsersModelTest
 *
 * @author CC-Student
 */
class UsersModelTest extends TestCase {
    //put your code here
    private $firstname = 'First';
    private $lastname = 'Test';
    private $username = 'firsttest';
    private $email = 'firsttest@nsemi.org';
    private $password = 'password';
    
    public function setUp() {
        $this->resetInstance();
        $this->CI->load->model('Users_model');
        $this->obj = $this->CI->Users_model;
    }
    
    public function testUsersExist() {
        $users = $this->obj->get_users();
        $this->assertTrue($users != null && ! empty($users));
    }
    
    public function testUserDontExist() {
        $user = $this->obj->get_user_with_username($this->username);
        $this->assertTrue(NULL == $user);
    }

    /**
     * @depends testUserDontExist
     */
    public function testCreateUser() {
        $this->obj->create_user(
                $this->firstname, 
                $this->lastname, 
                $this->username, 
                $this->email, 
                $this->password);
        
        $user = $this->obj->get_user_with_username($this->username);
        $this->assertEquals($this->firstname, $user['firstname']);
        $this->assertEquals($this->lastname, $user['lastname']);
        $this->assertEquals($this->email, $user['email']);
        $this->assertTrue(NULL == $user['password']);
    }
    
    /**
     * @depends testCreateUser
     */
    public function testUserExistWithUsername() {
        $user = $this->obj->get_user_with_username($this->username);
        $this->assertEquals($this->firstname, $user['firstname']);
        $this->assertEquals($this->lastname, $user['lastname']);
        $this->assertEquals($this->email, $user['email']);
        $this->assertTrue(NULL == $user['password']);
    }
    
    /**
     * @depends testCreateUser
     */
    public function testUserExistWithId() {
        $usera = $this->obj->get_user_with_username($this->username);
        $user = $this->obj->get_user_with_id($usera['user_id']);

        $this->assertEquals($this->firstname, $user['firstname']);
        $this->assertEquals($this->lastname, $user['lastname']);
        $this->assertEquals($this->email, $user['email']);
        $this->assertTrue(NULL == $user['password']);
    }
    
    /**
     * Test a user's successfull login.
     * 
     * @requires    This tests requires a user in the database with the given 
     *              creadentials.
     * @test
     * @depends testCreateUser
     */
    public function testUserLogin() {
        $result = $this->obj->login_user($this->username, $this->password);
        $this->assertTrue($result);

        $user = $this->obj->get_user_with_username($this->username);
        $this->assertTrue($user['is_logged_in'] == '1');
    }
    
    /**
     * Test a user's invalid login, given a wrong username.
     * 
     * @requires    This tests requires a user in the database with the given 
     *              creadentials.
     * @test
     * @depends testCreateUser
     */
    public function testUserLoginFailsWithWrongUsername() {
        $result = $this->obj->login_user('$this->username', $this->password);
        $this->assertFalse($result);
    }
    
    /**
     * Test a user's invalid login, given a wrong password.
     * 
     * @requires    This tests requires a user in the database with the given 
     *              creadentials.
     * @test
     * @depends testCreateUser
     */
    public function testUserLoginFailsWithWrongPassword() {
        $result = $this->obj->login_user($this->username, '$this->password');
        $this->assertFalse($result);
    }

    /**
     * Test a user logout.
     * 
     * @requires    A user we want to logout of the system.
     * @test
     * @depends     testUserLogin
     */
    public function testUserLogout() {
        $result = $this->obj->logout_user($this->username);
        $this->assertTrue($result);

        $user = $this->obj->get_user_with_username($this->username);
        $this->assertFalse($user['is_logged_in'] == '1');
    }

    /**
     * @depends testCreateUser
     */
    public function testDeleteUser() {
        $this->obj->delete_user_with_username($this->username);        
        $user = $this->obj->get_user_with_username($this->username);
        $this->assertTrue(empty($user));
    }
    
}
