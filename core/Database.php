<?php 
namespace app\core;

use PDO;

class Database 
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function runMigrations()
    {
        $this->createMigrationData();
        $FileMigrationDatabase = $this->getFileMigrationData();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR.'\migrations');
        // array_diff lọc phần tử khác nhau của 2 array
        $checkFileMigration = array_diff($files, $FileMigrationDatabase);
        foreach ($checkFileMigration as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            // import file 
            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
            // lay ten file m0001_initial
            $className = pathinfo($migration, PATHINFO_FILENAME);
            // Khoi tao class file
            $instance = new $className();
            $instance->up();
            // applied success data end process
            $newMigrations[] = $migration;
        }
        
        if (!empty($newMigrations)) {
            $this->saveDataMigrations($newMigrations);
        } else {
            echo 'All migrations apply';
        }
        // 0]=>
        //   string(1) "."
        //   [1]=>
        //   string(2) ".."
        //   [2]=>
        //   string(17) "m0001_initial.php"
        //   [3]=>
        //   string(19) "m0002_something.php"
    }

    // Tạo thư mục
    public function createMigrationData()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration_file VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP                
            ) ENGINE=INNODB;"
        );
    }

    public function getFileMigrationData()
    {
        $statement = $this->pdo->prepare("SELECT migration_file FROM migrations");
        $statement->execute();
        // return array column file in folder migrations
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveDataMigrations(array $migrations)
    {
        // Tạo một mảng chứa các giá trị của migration để thêm vào truy vấn
        $values = array_map(fn($m) => "('$m')", $migrations);
        
        // Chuyển đổi mảng thành một chuỗi
        $strValues = implode(",", $values);

        // Sử dụng $strValues trong truy vấn SQL
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration_file) VALUES $strValues");

        // Thực hiện truy vấn
        $statement->execute();
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

}