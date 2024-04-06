<?php
/*
Plugin Name: Student Records Plugin
Description: Displays student records in a Bootstrap Table with pagination.
Version: 1.0
*/

// Activation Hook
register_activation_hook(__FILE__, 'student_records_plugin_activate');

function student_records_plugin_activate() {
    // Activation actions, if any
}

// Deactivation Hook
register_deactivation_hook(__FILE__, 'student_records_plugin_deactivate');

function student_records_plugin_deactivate() {
    // Deactivation actions, if any
}

// Enqueue Scripts and Styles
function student_records_enqueue_scripts() {
    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
    wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . 'css/custom-style.css'); // Adjust the path if necessary
}
add_action('wp_enqueue_scripts', 'student_records_enqueue_scripts');

// Shortcode to Display the Table
function student_records_shortcode($atts) {
    // Database Connection
    global $wpdb;
    $table_name = $wpdb->prefix . 'StudentRecords'; // Adjust table name if necessary

    // Query to fetch student records
    $student_records = $wpdb->get_results("SELECT * FROM $table_name");

    // Start output buffering
    ob_start();

    // Display student records in a Bootstrap Table
    ?>
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Date of Birth</th>
                    <th>Mother Tongue</th>
                    <th>Blood Group</th>
                    <th>Known Dust Allergies</th>
                    <th>Mother's Name</th>
                    <th>Father's Name</th>
                    <th>Nationality</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($student_records as $record) : ?>
                    <tr>
                        <td><?php echo $record->student_id; ?></td>
                        <td><?php echo $record->full_name; ?></td>
                        <td><?php echo $record->phone_number; ?></td>
                        <td><?php echo $record->dob; ?></td>
                        <td><?php echo $record->mother_tongue; ?></td>
                        <td><?php echo $record->blood_group; ?></td>
                        <td><?php echo $record->known_dust_allergies; ?></td>
                        <td><?php echo $record->mother_name; ?></td>
                        <td><?php echo $record->father_name; ?></td>
                        <td><?php echo $record->nationality; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php

    // End output buffering and return content
    return ob_get_clean();
}
add_shortcode('student_records_table', 'student_records_shortcode');

