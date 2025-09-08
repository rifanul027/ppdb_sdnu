<?php

if (!function_exists('setToast')) {
    /**
     * Set toast message in session flash data
     *
     * @param string $type success|error|warning|info
     * @param string $title Toast title
     * @param string $message Toast message
     * @return void
     */
    function setToast($type, $title, $message) {
        session()->setFlashdata('toast_type', $type);
        session()->setFlashdata('toast_title', $title);
        session()->setFlashdata('toast_message', $message);
    }
}

if (!function_exists('setSuccessToast')) {
    /**
     * Set success toast message
     *
     * @param string $title Toast title
     * @param string $message Toast message
     * @return void
     */
    function setSuccessToast($title, $message) {
        setToast('success', $title, $message);
    }
}

if (!function_exists('setErrorToast')) {
    /**
     * Set error toast message
     *
     * @param string $title Toast title
     * @param string $message Toast message
     * @return void
     */
    function setErrorToast($title, $message) {
        setToast('error', $title, $message);
    }
}

if (!function_exists('setWarningToast')) {
    /**
     * Set warning toast message
     *
     * @param string $title Toast title
     * @param string $message Toast message
     * @return void
     */
    function setWarningToast($title, $message) {
        setToast('warning', $title, $message);
    }
}

if (!function_exists('setInfoToast')) {
    /**
     * Set info toast message
     *
     * @param string $title Toast title
     * @param string $message Toast message
     * @return void
     */
    function setInfoToast($title, $message) {
        setToast('info', $title, $message);
    }
}
