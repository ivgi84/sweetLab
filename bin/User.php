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
            array_push($existingUsers->Users, array('name' => $user->getName(), 'tel' => $user->getTel(), 'email' => $user->getEmail(),'subscribe'=>$postData->subscribed));

            if(file_put_contents($this->data, json_encode($existingUsers))){
                $response = '';
                $sent = $this->sendEmail($user, $postData->subscribed);
                if($sent) $response .= 'Mail has been sent ';
                $response .= 'Data has been updated';
                $user->response->setResult(true);
                $user->response->setUserMsg($response);
            }
            else{
                $user->response->setError(true);
                $user->response->setUserMsg('Error writing data');
            }
        }
        $user->response->setAjaxResponce();
    }

    function sendEmail($user, $subscribed){
        $name = $user->getName();
        $tel = $user->getTel();
        $email = $user->getEmail();

        $from = 'donotreply@sweetLab.com';
        $headers = "From: <$from>\n";
        $headers .= "MIME-version: 1.0\n";
        $headers.= "Content-type: text/html; charset= iso-8859-1\n";


        $to = 'agaymay@mail.ru';
        //$to = 'ivgi84@gmail.com';
        $subject = 'New '.$subscribed.' Subsriber';

        $message = '<html><head></head><body>';
        $message .= '<table width="400" cellspacing="0" cellpadding="10" border="1" align="center">
            <tr><td>Name: </td><td>'.$name.'<td><tr>
            <tr><td>Tel: </td><td>'.$tel.'<td><tr>
            <tr><td>Email: </td><td>'.$email.'<td><tr>
            <tr><td>Subscribtion: </td><td>'.$subscribed.'<td><tr>
        </table>';
        $message .= '</body></html>';

        $sent = mail($to, $subject, $message, $headers);

        return $sent;
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