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

        public function updateCart($idProduct) 
        {
            
            $tableName = $this->tableName();
            $columnName = 'product_product_id';
            $quantity = 'quantity';
            $statement = self::prepare("UPDATE $tableName SET quantity=:quantity WHERE $columnName = $idProduct");
            $statement->bindValue(":quantity", intval($this->{$quantity}));
            $statement->execute();
            $result = [
                // 'queryString' => $queryString,
                'success' => $statement,
            ];
            
            return true;
        }

        public function saveCartXhr($idProduct, $idUser) 
        {
            
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $columnName = 'product_product_id';
            $sqlCheckColumn = "SELECT * FROM $tableName WHERE $columnName = $idProduct AND user_user_id = $idUser";
            $stmt = self::prepare($sqlCheckColumn);
            $check = $stmt->execute();
            $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($fetch)) {
                $quantity = 'quantity';
                $statement = self::prepare("UPDATE $tableName SET quantity=:quantity WHERE $columnName = $idProduct");
                $statement->bindValue(":quantity", $fetch[0]['quantity'] + intval($this->{$quantity}));
            }else {
                $params = array_map(fn($attr) => ":$attr", $attributes);
                $queryString = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") 
                VALUES (".implode(',', $params).")");
                $statement = $queryString;
                foreach ($attributes as $attribute) {
                    $statement->bindValue(":$attribute", $this->{$attribute});
                }
            }
            
            $success = $statement->execute();
            // response xhr.responseText tra ve la 1 object pdo -> json kiem tra o phan preview xem no tra ve la gi sau do encode json phan do
            // PHAI GUI LAI DU LIEU LA 1 CHUOI JSON VI`` const responseData = xhr.responseText;
                        // const parsedData = JSON.parse(responseData);
            $result = [
                // 'queryString' => $queryString,
                'success' => $success,
                'result' => $fetch,
                'check' => $check
            ];
        
            // Chuyển đổi mảng thành JSON và in ra hoặc trả về tùy ý
            $jsonResult = json_encode($result);
        
            // In ra JSON hoặc trả về nếu cần
            // $result = [
            //     'queryString' => $queryString,
            //     'success' => $success,
            // ]; de trinh duyet lay duoc phan da duoc encode json
            echo $jsonResult; 
            // -> phan json duoc in ra

            return true;
        }

        public function fetchFillter($gender, $categoryId)
        {
            // SELECT * FROM sanpham WHERE (gender = 'nam' OR gender = 'nu') 
            // AND category = 't-shirt';
            $tableName = $this->tableName();
            $sql = $gender ? 'WHERE ('. implode(" OR ", array_map(fn($atrr)=>"gender = :$atrr", $gender)). ')' : '' ;
            $sql2 = $categoryId ? 'AND category_category_id ='. $categoryId : '';
            if (empty($gender)) {
                $sql2 = ' WHERE category_category_id ='. $categoryId;
            }
            $statement = self::prepare("SELECT * FROM $tableName $sql $sql2");
            foreach ($gender as $item) {
                $statement->bindValue(":$item", $item);
            }
            // var_dump($statement);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update($arrCondition)
        {
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $condition = implode(", ", array_map(fn($key, $value) => "$key = $value", array_keys($arrCondition), array_values($arrCondition)));
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
            $statement = self::prepare("SELECT * FROM $tableName ");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }


        public function fetchQuery(?array $queryTable1, ?array $queryTable2 , $params) 
        // [
        //     "product" => new Product() -> $primaryKey,
        //     "user" => new User,
        // ]
        {
            // SELECT *
            // FROM cart c
            // JOIN sanpham s ON c.product_product_id = s.id_sanpham
            // WHERE c.id_user = iduser
            // ORDER BY l.id_sanpham ASC;
            $foreignKey = explode(', ', $this->getUserName());
            $tableName = $this->tableName();
            $sql = implode(" JOIN ", array_map(fn($key, $value)=>"$key $key[3] ON $tableName[3].$foreignKey[0] = $key[3].$value[0]", array_keys($queryTable1), array_values($queryTable1)));
            $sql2 = implode(" JOIN ", array_map(fn($key1, $value1, $key2, $value2)=>"JOIN $key2 $key2[3] ON $key1[3].$value1[1] = $key2[3].$value2", array_keys($queryTable1), array_values($queryTable1), array_keys($queryTable2), array_values($queryTable2))) ?? '';
            $statement = self::prepare("SELECT * FROM $tableName $tableName[3] JOIN $sql $sql2 WHERE $tableName[3].$foreignKey[1] = $params");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function fetchTotalPrice($params)
        {
            $tableName = $this->tableName();
            $sqlSum = "SELECT SUM(p.price * c.quantity) AS total FROM $tableName c JOIN product p ON c.product_product_id = p.product_id WHERE c.user_user_id = $params";
            $result = Application::$app->db->pdo->query($sqlSum);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return number_format($row['total'] ?? 0, 3) ; 
        }

        public static function prepare($sql)
        {
            return Application::$app->db->pdo->prepare($sql);
        }
    }
?>