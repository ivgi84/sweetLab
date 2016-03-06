<?php
include('response.php');

class User
{
    private $data = '../data/users.json';
    private $response;

    private $userName;
    private $userEmail;
    private $userTel;


    function __construct() {
        $this->response = new Response();
    }

    public function setName($name) {
        if (isset($name) && !empty($name)){
            $this->userName = $name;
            return true;
        } else {
            $this->response->setError(true);
            $this->response->setUserMsg('First name is not valid');
            return false;
        }
    }

    public function setTel($tel) {
        if (isset($tel) && !empty($tel)) {
            $this->userTel = $tel;
            return true;
        } else {
            $this->response->setError(true);
            $this->response->setUserMsg('Last name is not valid');
            return false;
        }
    }
    public function setEmail($email) {
        if (isset($email) && !empty($email)) {
            $this->userEmail = $email;
            return true;
        } else {
            $this->response->setError(true);
            $this->response->setUserMsg('Last name is not valid');
            return false;
        }
    }

    public function getName() {
        return $this->userName;
    }
    public function getTel() {
        return $this->userTel;
    }
    public function getEmail() {
        return $this->userEmail;
    }


    function getUsersList() {
        $users = file_get_contents($this->data);
        if ($users) {
            return $users;
        }
        else{
            return false;
        }
    }

    function addUser() {
        $postData = json_decode(file_get_contents("php://input"));

        $user = new User();

        if($user->setName($postData->name) && $user->setTel($postData->tel) && $user->setEmail($postData->email)){
            $existingUsers = json_decode($this->getUsersList());
            array_push($existingUsers->Users, array('name' => $user->getName(), 'tel' => $user->getTel(), 'email' => $user->getEmail()));

            if(file_put_contents($this->data, json_encode($existingUsers))){
                $this->response->setResult(true);
                $this->response->setUserMsg('Data has been updated');
            }
            else{
                $this->response->setError(true);
                $this->response->setUserMsg('Error writing data');
            }
        }
        $user->response->setAjaxResponce();
    }

}

if (isset($_GET['action'])) {

    $action = $_GET['action'];
    $User = new User();
    switch ($action) {
        case 'addUser':
            $User->addUser();
            break;
    }
}