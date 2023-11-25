<?php
namespace app\core;

class Session 
{
    protected const FLAH_KEY = 'flash_messages';
    public function __construct()
    {
        session_start();    
        $flashMessages = $_SESSION[self::FLAH_KEY] ?? [];
        // Dòng này có nghĩa là bạn đang thay đổi trực tiếp mỗi phần tử của mảng $flashMessages. Nếu bạn không sử dụng tham chiếu (&), một bản sao của giá trị sẽ được tạo ra và chỉ thay đổi bản sao đó trong vòng lặp, không ảnh hưởng đến giá trị thực tế trong mảng.
        // &$flahMessage thay đổi giá trị gốc
        foreach ($flashMessages as $key => &$flahMessage) {
            $flahMessage['removed'] = true;
        }
        $_SESSION[self::FLAH_KEY] = $flashMessages;
    }
    
    public function set($key, $value) 
    {
        return $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLAH_KEY][$key] = [
            'removed' => false,
            'message' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLAH_KEY][$key]['message'] ?? false;
    }

    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLAH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flahMessage) {
            if ($flahMessage['removed']) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLAH_KEY] = $flashMessages;
    }
}