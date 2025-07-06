<?php
    # Alerting with server messages
    function recieve_server_messages() {
        // Define possible alert types, their Bootstrap classes, and FontAwesome icons
        $alertTypes = [
            'success' => ['class' => 'alert-success', 'icon' => 'fa-circle-check'],
            'error' => ['class' => 'alert-danger', 'icon' => 'fa-circle-xmark'],
            'warning' => ['class' => 'alert-warning', 'icon' => 'fa-triangle-exclamation'],
            'info' => ['class' => 'alert-primary', 'icon' => 'fa-circle-info']
        ];

        // Loop through each alert type and check if the corresponding global variable is set
        foreach ($alertTypes as $type => $details) {
            if (isset($GLOBALS[$type]) && !empty($GLOBALS[$type])) {
                $message = $GLOBALS[$type];
                $class = $details['class'];
                $icon = $details['icon'];
                echo "<div class='alert {$class} fade show hidden' role='alert'>";
                echo "<i class='fa-solid {$icon}'></i> " . htmlspecialchars($message);
                echo "</div>";
            }
        }
    }

    # Setting page title
    function view_title() {
        // Check if the global page title is set, otherwise use a default title
        if (isset($GLOBALS['page_title']) && !empty($GLOBALS['page_title'])) {
            $sanitizedTitle = htmlspecialchars("Vertex Vault - " . $GLOBALS['page_title'], ENT_QUOTES, 'UTF-8');
        } else {
            $sanitizedTitle = "Vertex Vault";
        }
    
        // Return the sanitized title
        return $sanitizedTitle;
    }
    
    # Determining user device session on the server
    function determine_user_session($ensure_status) {
        if ($ensure_status) {
            // Ensure the session is started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }

        // Check if the user session exists
        if (isset($_SESSION['role'])) {
            return true; // User session exists
        } else {
            return false; // User session does not exist
        }
    }

    # Getting user device MAC Address
    function get_mac_address() {
        // Execute the getmac command to get network configuration
        $output = shell_exec('getmac');

        // Use regular expression to match the MAC address
        preg_match('/([a-fA-F0-9]{2}-){5}[a-fA-F0-9]{2}/', $output, $matches);

        // Return the first match
        return isset($matches[0]) ? $matches[0] : 'MAC Address not found';
    }

    # Adjusting sessions max life time
    function adjust_session_max_life_time() {
        ini_set('session.gc_maxlifetime', 86400 * 30);
        session_set_cookie_params(86400 * 30);
    }
?>
