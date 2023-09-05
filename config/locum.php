<?php
/**
 * Created by PhpStorm.
 * User: mustafa.mughal
 * Date: 31/01/2017
 * Time: 03:27 PM
 */

return [
    // Industry Array
    'job_status_array' => array(
        1 => 'Draft',
        2 => 'Published',
        3 => 'Closed',
        4 => 'Expired',

    ),

    'job_overall_status_array' => array(
        'draft' => 'Draft',
        'publish' => 'Published',
        'close' => 'Closed', // move to archive
        'expire' => 'Expired', // through cron when no candidate applied on job
        'reject' => 'Rejected', //when after hiring candidate rejected from job, Auto published
        'hire' => 'Hired',
        'waiting' => 'Waiting for Timesheet', // through cron when a day is passed

        'timesheet' => 'Timesheet Submitted', // when timesheet is submitted (completed 1.1)
        'notify' => 'Notified By Manager', //(completed 1.2)
        'approved' => 'Approved By Manager', //(completed 1.3)
        'payroll' => 'Sent to Payroll', //(completed 1.4)
        'payment' => 'Payment Recieved'// move to archive
    ),

    'application_status_array' => array(
        0 => 'Cancelled',
        1 => 'New',
        2 => 'Hired'
    ),

    'job_hire_array' => array(
        1 => 'Not Hired',
        2 => 'Hired'
    ),

    'timesheet_status_array' => array(
        1 => 'Submitted',
        2 => 'Notified By Manager',
        3 => 'Approved By manager',
        4 => 'Sent To Payroll'
    ),

    'standard_in_time' => '08:00 am'
];