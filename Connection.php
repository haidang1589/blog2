<?php
/**
 * Links
 *
 * http://hoclaptrinhweb.org/lap-trinh/hoc-php/255-bai-11-thao-tac-voi-csdl-trong-php-thong-qua-pdo.html
 * https://code.tutsplus.com/tutorials/why-you-should-be-using-phps-pdo-for-database-access--net-12059
 *
 * Created by PhpStorm.
 * User: haidang
 * Date: 13/06/2017
 * Time: 13:34
 */

class Connection {
    private $config = array();

    private $connection;

    /**
     * Connection constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        $dsn = "mysql:host=". $this->config['db_host'].";dbname=" .  $this->config['db_name'];
        // cach viet tuong duong
        // $dsn = sprintf("mysql:host=%s;dbname=%s", $this->config['db_host'], $this->config['db_name']);

        // Set options
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Khoi tao connection
        try {
            return $this->connection = new PDO($dsn, $this->config['db_user'], $this->config['db_password'], $options);
        }
        // Catch any errors => Bat loi
        catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    /**
     * @param $sql
     * @param $data
     * @return bool
     */
    public function insert($sql, $data)
    {
        $stmt = $this
            ->getConnection()
            ->prepare($sql);

//        foreach ($parameters as $key => $value) {
//            $stmt->bindParam($key, $value);
//        }

        return $stmt->execute($data);
    }

    /**
     * @param $sql
     * @return array
     */
    public function fetchAll($sql)
    {
        $db = $this->getConnection();

        $stmt = $db->prepare($sql);

        //Thiết lập kiểu dữ liệu trả về
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}