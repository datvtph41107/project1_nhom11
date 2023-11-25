<?php 
    namespace app\core;
    use PDO;

    abstract class DbModel extends Model
    {
        abstract public function tableName(): String;

        abstract public function attributes(): array;

        abstract public function primaryKey(): string;

        abstract public function getUserName(): string;

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

        public function update($arrCondition)
        {
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            
            $condition = $sql = implode(", ", array_map(fn($key, $value) => "$key = $value", array_keys($arrCondition), array_values($arrCondition)));
            $sql = implode(", ", array_map(fn($atrr)=>"$atrr =:$atrr", $attributes));
            $statement = self::prepare("UPDATE $tableName SET $sql WHERE $condition");
            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
            $statement->execute();
            return true;
        }

        public function delete($condition)
        {
            $tableName = $this->tableName();
            $sql = implode(", ", array_map(fn($key, $value)=>"$key=$value", array_keys($condition), array_values($condition)));
            $statement = self::prepare("DELETE FROM $tableName WHERE $sql");
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

        public function fetchAll($where) 
        {
            $tableName = $this->tableName();
            $attributes = $where[0];
            $statement = self::prepare("SELECT * FROM $tableName");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function prepare($sql)
        {
            return Application::$app->db->pdo->prepare($sql);
        }
    }
?>