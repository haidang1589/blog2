<?php
/**
 * Created by PhpStorm.
 * User: haidang
 * Date: 13/06/2017
 * Time: 13:49
 */

$action = isset($_GET['action']) ? $_GET['action'] : null;
$user = new User($mysql);

switch ($action) {
    case 'add':
        $user->addAction();
        break;
    case 'edit':
        $user->updateAction();
        break;
    case 'delete':
        $user->deleteAction();
        break;
    default:
        $user->listAction();
}

class User
{
    /**
     * @var Connection
     */
    private $mysql;

    /**
     * User constructor.
     * @param Connection $mysql
     */
    public function __construct(Connection $mysql)
    {
        $this->mysql = $mysql;
    }


    public function addAction()
    {
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;

        // kiem tra du lieu co submit hay chua
        if ($username && $password) {
            // Co du lieu
            // Thao tac voi database



            // kiem tra co ton tai trong database chua?

            // Neu chua, insert
            $success = $this->mysql->insert(
                "INSERT INTO user (username, password) values (:username, :password)",
                [
                    'username' => $username,
                    'password' => $password
                ]
            );

            if ($success) {
                // insert thanh cong!!!
                echo 'Insert thanh cong!';
            }

        }

        include __DIR__ .'/../templates/admin/user/add.phtml';
    }

    public function listAction()
    {
//        $users = array(
//            [
//                'id' => 1,
//                'username' => 'haidang'
//            ],
//            [
//                'id' => 2,
//                'username' => 'haidang2'
//            ],
//
//        );

//        $db = $this->mysql->getConnection();
//
//        $stmt = $db->prepare('SELECT id, username from user');
//
//        //Thiết lập kiểu dữ liệu trả về
//        $stmt->setFetchMode(PDO::FETCH_ASSOC);
//        $stmt->execute();
//        $users = $stmt->fetchAll();

        $users = $this->mysql->fetchAll('SELECT id, username from user');

        include __DIR__ .'/../templates/admin/user/list.phtml';
    }

    public function updateAction()
    {

    }

    public function deleteAction()
    {

    }
}
