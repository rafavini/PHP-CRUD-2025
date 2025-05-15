<?php
class ToastComponent {
    public static function render() {
        if (isset($_SESSION['toast'])) {
            $type = $_SESSION['toast']['type'];
            $message = $_SESSION['toast']['message'];

            echo "<div class='toast $type'>$message</div>";
            echo "
            <script>
                setTimeout(() => {
                    const toast = document.querySelector('.toast');
                    if (toast) {
                        toast.style.opacity = '0';
                        setTimeout(() => toast.remove(), 500);
                    }
                }, 3000);
            </script>";

            unset($_SESSION['toast']);
        }
    }
}
