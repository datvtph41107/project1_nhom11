<?php 
    namespace app\core;

    abstract class DbModel extends Model
    {
        abstract public function tableName(): String;

        abstract public function attributes(): array;

        abstract public function primaryKey(): string;

        abstract public function getUserName(): string;

        abstract public function isAdmin(): bool;

        public function save()
        {
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr) => ":$attr", $attributes);
            $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") 
                VALUES (".implode(',', $params).")");
            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
            $statement->execute();
            return true;
        }

        public function findOne($where) 
        {
            // tableName là abstract sd điều này để gọi hàm con 
            // static::tableName sẽ là của lớp User::tableName()
            $tableName = $this->tableName();
            $attributes = array_keys($where);
            $sql = implode("AND ", array_map(fn($atrr)=>"$atrr = :$atrr", $attributes));
            $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", $item);
            }
            $statement->execute();
            // static::class lấy tên lớp hiện tại của đối tượng User
            // fetchobj để chuyển các cột của email tìm đc thành 1 lớp obj
            return $statement->fetchObject(static::class);
        }

        public static function prepare($sql)
        {
            return Application::$app->db->pdo->prepare($sql);
        }
    }
?>