<?php
session_start();

function setToast($message, $icon = 'info', $position = 'top-end', $timer = 3000) {
    $_SESSION['toast'] = [
        'message' => $message,
        'icon' => $icon,
        'position' => $position,
        'timer' => $timer
    ];
}

function showToast() {
    if (isset($_SESSION['toast'])) {
        $t = $_SESSION['toast'];
        echo "
        <script>
        Swal.fire({
            toast: true,
            position: '{$t['position']}',
            icon: '{$t['icon']}',
            title: '{$t['message']}',
            showConfirmButton: false,
            timer: {$t['timer']},
            timerProgressBar: true
        });
        </script>
        ";
        unset($_SESSION['toast']); // só mostra uma vez
    }
}
