<?php

namespace Database;

use Exception;
use PDO;

class MySqlDb
{
    /**
     * @var array
     */
    private $db;

    const TABLE_SINEMA = 'so_sinema';
    const TABLE_SALON = 'so_salon';
    const TABLE_FILM = 'so_film';
    const TABLE_GOSTERIM = 'so_gosterim';
    const TABLE_BILET = 'so_bilet';
    const TABLE_SATIS = 'so_satis';
    const TABLE_SEANS = 'so_seans';
    const TABLE_KULLANICI = 'so_kullanici';
    const TABLE_OYUNCU = 'so_oyuncu';
    const TABLE_YONETMEN = 'so_yonetmen';
    const TABLE_FILM_OYUNCU = 'so_film_oyuncu';
    const TABLE_FILM_YONETMEN = 'so_film_yonetmen';
    const TABLE_AYARLAR = 'so_ayarlar';


    /**
     * @var array
     */
    private $tables = [
        self::TABLE_SINEMA => 'CREATE TABLE IF NOT EXISTS ' . self::TABLE_SINEMA . ' (
                                            id INT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                            ad VARCHAR(255) NOT NULL,
                                            yer TEXT,
                                            stamp_updated timestamp default now() on update now(),
                                            stamp_created TIMESTAMP default CURRENT_TIMESTAMP()
                                            )',
        self::TABLE_SALON => 'CREATE TABLE IF NOT EXISTS ' . self::TABLE_SALON . ' (
                                            id INT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                            ad VARCHAR(255) NOT NULL,
                                            kapasite INT(20) UNSIGNED NOT NULL,
                                            ses_sistemi VARCHAR(255),
                                            sinema_id INT(20) UNSIGNED NOT NULL,
                                            stamp_updated timestamp default now() on update now(),
                                            stamp_created TIMESTAMP default CURRENT_TIMESTAMP()
                                            )',
        self::TABLE_FILM => 'CREATE TABLE IF NOT EXISTS ' . self::TABLE_FILM . ' (
                                            id INT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                            ad VARCHAR(255) NOT NULL,
                                            yil INT(20) UNSIGNED,
                                            dil VARCHAR(255),
                                            sure VARCHAR(255) NOT NULL,
                                            stamp_updated timestamp default now() on update now(),
                                            stamp_created TIMESTAMP default CURRENT_TIMESTAMP()
                                            )',
        self::TABLE_GOSTERIM => 'CREATE TABLE IF NOT EXISTS ' . self::TABLE_GOSTERIM . ' (
                                            id INT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                            salon_id INT(20) UNSIGNED NOT NULL,
                                            film_id INT(20) UNSIGNED NOT NULL,
                                            seans_id INT(20) UNSIGNED NOT NULL,
                                            tarih DATE NOT NULL,
                                            stamp_updated timestamp default now() on update now(),
                                            stamp_created TIMESTAMP default CURRENT_TIMESTAMP()
                                            )',
        self::TABLE_BILET => 'CREATE TABLE IF NOT EXISTS ' . self::TABLE_BILET . ' (
                                            id INT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                            gosterim_id INT(20) UNSIGNED NOT NULL,                                        
                                            ucret DOUBLE(5,2) NOT NULL,
                                            stamp_updated timestamp default now() on update now(),
                                            stamp_created TIMESTAMP default CURRENT_TIMESTAMP()                                        
                                            )',
        self::TABLE_SATIS => 'CREATE TABLE IF NOT EXISTS ' . self::TABLE_SATIS . ' (
                                            id INT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                            bilet_id INT(20) UNSIGNED NOT NULL,
                                            koltuk_no SMALLINT(5) UNSIGNED NOT NULL,
                                            user_id INT(20) UNSIGNED NOT NULL,
                                            stamp_updated timestamp default now() on update now(),
                                            stamp_created TIMESTAMP default CURRENT_TIMESTAMP()
                                            )',
        self::TABLE_SEANS => 'CREATE TABLE IF NOT EXISTS ' . self::TABLE_SEANS . ' (
                                            id INT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                            zaman VARCHAR(255) NOT NULL,
                                            stamp_updated timestamp default now() on update now(),
                                            stamp_created TIMESTAMP default CURRENT_TIMESTAMP()
                                            )',
        self::TABLE_KULLANICI => 'CREATE TABLE IF NOT EXISTS ' . self::TABLE_KULLANICI . ' (
                                            id INT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                            kadi VARCHAR(255) NOT NULL,
                                            parola VARCHAR(255) NOT NULL,
                                            ad VARCHAR(255) NOT NULL,
                                            email VARCHAR(255),
                                            tel VARCHAR(255),
                                            last_login VARCHAR(255),
                                            stamp_updated timestamp default now() on update now(),
                                            stamp_created TIMESTAMP default CURRENT_TIMESTAMP()
                                            )',
        self::TABLE_OYUNCU => 'CREATE TABLE IF NOT EXISTS ' . self::TABLE_OYUNCU . ' (
                                            id INT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                            ad VARCHAR(255) NOT NULL,
                                            stamp_updated timestamp default now() on update now(),
                                            stamp_created TIMESTAMP default CURRENT_TIMESTAMP()
                                            )',
        self::TABLE_YONETMEN => 'CREATE TABLE IF NOT EXISTS ' . self::TABLE_YONETMEN . ' (
                                            id INT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                            ad VARCHAR(255) NOT NULL,
                                            stamp_updated timestamp default now() on update now(),
                                            stamp_created TIMESTAMP default CURRENT_TIMESTAMP()
                                            )',
        self::TABLE_FILM_OYUNCU => 'CREATE TABLE IF NOT EXISTS ' . self::TABLE_FILM_OYUNCU . ' (
                                            id INT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                            film_id INT(20) UNSIGNED NOT NULL,
                                            oyuncu_id INT(20) UNSIGNED NOT NULL,
                                            stamp_updated timestamp default now() on update now(),
                                            stamp_created TIMESTAMP default CURRENT_TIMESTAMP()
                                            )',
        self::TABLE_FILM_YONETMEN => 'CREATE TABLE IF NOT EXISTS ' . self::TABLE_FILM_YONETMEN . ' (
                                            id INT(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                                            film_id INT(20) UNSIGNED NOT NULL,
                                            yonetmen_id INT(20) UNSIGNED NOT NULL,
                                            stamp_updated timestamp default now() on update now(),
                                            stamp_created TIMESTAMP default CURRENT_TIMESTAMP()
                                            )',
        self::TABLE_AYARLAR => 'CREATE TABLE IF NOT EXISTS ' . self::TABLE_AYARLAR . ' (
                                            setting_name VARCHAR(255) PRIMARY KEY,
                                            setting_value VARCHAR(255),
                                            stamp_updated timestamp default now() on update now(),
                                            stamp_created TIMESTAMP default CURRENT_TIMESTAMP()
                                            )',

    ];

    /**
     * The Query to run against the FileSystem
     * @var PDO
     */
    private $conn;

    /**
     * @var Db
     */
    private static $_instance;

    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();

            if (defined('DB_SERVER') &&
                defined('DB_NAME') &&
                defined('DB_USERNAME') &&
                defined('DB_PASSWORD')) {

                self::$_instance->db = [
                    'server' => DB_SERVER,
                    'db_name' => DB_NAME,
                    'username' => DB_USERNAME,
                    'password' => DB_PASSWORD
                ];
                self::$_instance->createAllTables();
            }
        }

        return self::$_instance;
    }

    private function __construct()
    {
        $this->connect();
    }

    function setup($server, $db_name, $username, $password)
    {
        if ($server == null || $db_name == null || $username == null || is_null($password))
            throw new \InvalidArgumentException("Mysql veritabanı ayarları null gönderilemez");
        $this->db = [
            'server' => $server,
            'db_name' => $db_name,
            'username' => $username,
            'password' => $password
        ];
    }

    function connect() //
    {
        $dsn = "mysql:host=" . $this->db['server'] . ";dbname=" . $this->db['db_name'];
        $user = $this->db['username'];
        $pass = $this->db['password'];

        try {
            $this->conn = new PDO($dsn, $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$this->conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
            $this->conn->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
        } catch (PDOException $e) {
            echo "Bağlantı Hatası " . $e->getMessage();
        }
        return $this;
    }

    function createAllTables()// mysql php admin sayfasında sadece bir sinema veri tabanı  oluşturarak onun içindeki tablolar otomatik olarak gözükecek
    {
        foreach ($this->tables as $table_name => $sql) {
            $sth = $this->conn->prepare($sql);
            $sth->execute();
        }
    }

    function dropAllTables()
    {
        foreach ($this->tables as $table_name => $sql) {
            try {
                $sth = $this->conn->prepare("DROP TABLE IF EXISTS " . $table_name);
                $sth->execute();
            } catch (Exception $e) {
            }
        }
    }

    function dropTable($table)
    {
        $sth = $this->conn->prepare("DROP TABLE IF EXISTS $table");
        return $sth->execute();
    }

    function truncateTable($table)
    {
        $this->conn->exec($this->tables[$table]);
        $sth = $this->conn->prepare("TRUNCATE TABLE $table");
        return $sth->execute();
    }

    function insert($table, array $insData)
    {
        $columns = implode(" = ?, ", array_keys($insData));
        $columns .= " = ?";
        $escaped_values = array_values($insData); //array_map('mysql_real_escape_string', array_values($insData));
        //$values = implode("', '", $escaped_values);

        $query = $this->conn->prepare("INSERT INTO " . $table . " SET $columns");

        $insert = $query->execute($escaped_values);
        if ($insert)
            return $this->conn->lastInsertId();

        return false;
    }

    function insertAll($table, array $insDatas)
    {
        $return = [];
        foreach ($insDatas as $insData) {
            $return[] = $this->insert($table, $insData);
        }
        return $return;
    }

    function get($table, $where = "1=1", $column = '*', $fetch_options = PDO::FETCH_ASSOC, $limit = null)
    {
        return $this->conn->query("SELECT " . $column . " FROM " . $table . " WHERE " . $where)->fetchAll($fetch_options);
    }

    function count($table, $where = "1=1")
    {
        return $this->conn->query("SELECT COUNT(*) FROM " . $table . " WHERE " . $where)->fetchColumn();
    }

    function update($table, array $updData, $where = null, array $without_columns = array())
    {
        if ($where == null) {
            if (isset($updData['id'])) {
                $where = "id = " . $updData['id'];
                unset($updData['id']);
            } else {
                throw new Exception('Where ifadesi eksik. Id yok.');
            }
        }

        foreach ($without_columns as $without_column) {
            if (isset($updData[$without_column]))
                unset($updData[$without_column]);
        }

        $columns = implode(" = ?, ", array_keys($updData));
        $columns .= " = ?";
        $escaped_values = array_values($updData); //array_map('mysql_real_escape_string', array_values($updData));
        //$values = implode("', '", $escaped_values);

        $query = $this->conn->prepare("UPDATE " . $table . " SET " . $columns . " WHERE " . $where);

        return $query->execute($escaped_values);
    }

    function delete($table, $where)
    {
        return $this->conn->query("DELETE FROM " . $table . " WHERE " . $where);
    }

    function query($sql)
    {
        return $this->conn->query($sql);
    }

}