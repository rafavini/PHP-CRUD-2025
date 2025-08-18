<?php
function genereteCsrf()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['csrfToken'])) {
        unset($_SESSION['csrfToken']);
    }

    if (!isset($_SESSION['csrfToken'])) {
        $_SESSION['csrfToken'] = md5(uniqid(32));
    }
    return '<input type="hidden" id="csrfToken" name="csrfToken" value="' . $_SESSION['csrfToken'] . '">';
}
function validateTokenCsrf($token)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['csrfToken'])) {
        echo json_encode(['error' => 'falta do csrf token']);
        exit;
    }

    if ($_SESSION['csrfToken'] !== $token) {
        echo json_encode(['error' => 'csrf token inválido']);
        exit;
    }

    unset($_SESSION['csrfToken']);

    return TRUE;
}
