<?php
/**
 * Created by PhpStorm.
 * User: mustafa.mughal
 * Date: 31/01/2017
 * Time: 03:27 PM
 */

return [
    // Industry Array
    'complaint_category_array' => array(
        1 => 'Inspection',
        2 => 'Cleaning',
        3 => 'Lubricating',
        4 => 'Adjustment',
        5 => 'Replacement',
        6 => 'Shifting',
        7 => 'Assy. Replacement',
        8 => 'Replanishment',
        9 => 'Under observation',
        10 => 'Overhauling',
        11 => 'Operators training',
        12 => 'DF/ADF/D-ADF/RDF',
        13 => 'Convayer Assy',
        14 => 'Shorter',
        15 => 'VR Adjustment',
        16 => 'Optical Assy',
        17 => 'Cleaner Assy',
        18 => 'Developer Assy',
        19 => 'Pre /Pos Cornona',
        20 => 'TR /Sep Cornona',
        21 => 'Scanning Cornona',
        22 => 'Pre /TR Cornona',
        23 => 'Fuser Assy',
        24 => 'PCB Assy',

    ),
    'complaint_priority_array' => array(
        1 => 'High',
        2 => 'Medium',
        3 => 'Low',

    ),
    'discount_array' => array(
        1 => 'Amt',
        2 => 'Pct',
    ),
    'service_type_array' => array(
        1 => 'with parts',
        2 => 'without parts',
    ),
    'complaint_state_array' => array(
        1 => 'Open',
        2 => 'Closed',
    ),
    'complaint_status_array' => array(
        1 => 'Assigned',
        2 => 'In Progress',
        3 => 'New',
        4 => 'Pending Input',
    ),
    'complaint_product_type_array' => array(
        1 => 'Color PP',
        2 => 'Mono PP',
        3 => 'Mono MFP',
        4 => 'Color MFP',
        5 => 'Mono Printer',
        6 => 'Color Printer',
        7 => 'Copy Printer',
        8 => 'UV Printer',
        9 =>'Fax',
        10 =>'PABX',
        11 =>'Textile Printer',


    ),
    'tender_status_array' => array(
        1 => 'In Process',
        2 => 'Win',
        3 => 'Lose',
        4 => 'Scrap',

    ),
    'visit_type_array' => array(
        1 => 'Agreement Delivery & follow up',
        2 => 'Bill Delivery & follow up',
        3 => 'Break Down Call',
        4 => 'Complaint',
        5 => 'Estimate Delivery & follow up',
        6 => 'Installation',
        7 => 'Leave',
        8 => 'No Electricity',
        9 => 'Office Closed',
        10 => 'Out of station',
        11 => 'Parts Replacement',
        12 => 'Preventive maintenance',
        13 => 'R/Workshop',
        14 => 'Services',
        15 => 'Toner Delivery',
        16 => 'Courtesy Visit',
        17 => 'Others',

    ),
    'sector_array' => array(
        1 => 'Government',
        2 => 'Private',
        3 => 'Corporate',
        4 => 'Commercial',
        5 => 'Offset',
        6 => 'CRD',
        7 => 'Label',
        8 => 'OPS',
        9 => 'Solutions',
        10 => 'Dealer',
    ),
    'territory_array' => array(
        1 => 'T1',
        2 => 'T2',
        3 => 'T3',
        4 => 'T4',
        5 => 'T5',
        6 => 'T6',
    ),


    'year_array' => array(
        17 => '17',
        18 => '18',
        19 => '19',
        20 => '20',
        21 => '21',
        22 => '22',
        23 => '23',
        24 => '24',
        25 => '25',
        26 => '26',
        27 => '27',
        28 => '28',
        29 => '29',
        30 => '30',
        31 => '31',
        32 => '32',
        33 => '33',
        34 => '34',
    ),

    // Country Array
    'country_array' => array(
        1 => 'Pakistan'
    ),

    'currency_array' => array(
        1 => 'Rs',
        2 => 'US',
        3 => 'Eu',

    ),

    'qoute_invoice_status_array' => array(
        1 => 'Not Invoiced',
        2 => 'Invoiced'
    ),
    'qoute_documents_type_array' => array(
        1 => 'Qoutations',
        2 => 'Estimates'
    ),
    'qoute_approval_status_array' => array(
        1 => 'Approved',
        2 => 'Not Approved'
    ),

    'qoute_payment_terms_array' => array(
        1 => 'Cash',
        2 => 'Credit 30 days',
        3 => 'Credit 60 days',
        4 => 'Credit 90 days'
    ),

    'qoute_status_array' => array(
        1 => 'Draft',
        2 => 'Negotiation',
        3 => 'Delivered',
        4 => 'On Hold',
        5 => 'Confirmed',
        6 => 'Closed Accepted',
        7 => 'Closed Lost',
        8 => 'Lost',
        9 => 'Dead'
    ),

    // Allowed Type Array
    'allowed_type_array' => array(
        1 => 'Per Week',
        2 => 'Per Month',
        3 => 'Per 2 Months',
        4 => 'Per 3 Months',
        5 => 'Per 4 Months',
        6 => 'Per 5 Months',
        7 => 'Per 6 Months'
    ),
    // Full Half Array
    'working_full_half_array' => array(
        0 => 'Full Day',
        4 => 'Half Day'
    ),
    // Full Array
    'working_full_array' => array(
        0 => 'Full Day',
        4 => 'Half Day',
        8 => 'Non-working Day'
    ),
    // Time Range Array
    'time_array' => array(
        '00:00' => '12:00 AM',
        '00:15' => '12:15 AM',
        '00:30' => '12:30 AM',
        '00:45' => '12:45 AM',

        '01:00' => '01:00 AM',
        '01:15' => '01:15 AM',
        '01:30' => '01:30 AM',
        '01:45' => '01:45 AM',

        '02:00' => '02:00 AM',
        '02:15' => '02:15 AM',
        '02:30' => '02:30 AM',
        '02:45' => '02:45 AM',

        '03:00' => '03:00 AM',
        '03:15' => '03:15 AM',
        '03:30' => '03:30 AM',
        '03:45' => '03:45 AM',

        '04:00' => '04:00 AM',
        '04:15' => '04:15 AM',
        '04:30' => '04:30 AM',
        '04:45' => '04:45 AM',

        '05:00' => '05:00 AM',
        '05:15' => '05:15 AM',
        '05:30' => '05:30 AM',
        '05:45' => '05:45 AM',

        '06:00' => '06:00 AM',
        '06:15' => '06:15 AM',
        '06:30' => '06:30 AM',
        '06:45' => '06:45 AM',

        '07:00' => '07:00 AM',
        '07:15' => '07:15 AM',
        '07:30' => '07:30 AM',
        '07:45' => '07:45 AM',

        '08:00' => '08:00 AM',
        '08:15' => '08:15 AM',
        '08:30' => '08:30 AM',
        '08:45' => '08:45 AM',

        '09:00' => '09:00 AM',
        '09:15' => '09:15 AM',
        '09:30' => '09:30 AM',
        '09:45' => '09:45 AM',

        '10:00' => '10:00 AM',
        '10:15' => '10:15 AM',
        '10:30' => '10:30 AM',
        '10:45' => '10:45 AM',

        '11:00' => '11:00 AM',
        '11:15' => '11:15 AM',
        '11:30' => '11:30 AM',
        '11:45' => '11:45 AM',

        '12:00' => '12:00 PM',
        '12:15' => '12:15 PM',
        '12:30' => '12:30 PM',
        '12:45' => '12:45 PM',

        '13:00' => '01:00 PM',
        '13:15' => '01:15 PM',
        '13:30' => '01:30 PM',
        '13:45' => '01:45 PM',

        '14:00' => '02:00 PM',
        '14:15' => '02:15 PM',
        '14:30' => '02:30 PM',
        '14:45' => '02:45 PM',

        '15:00' => '03:00 PM',
        '15:15' => '03:15 PM',
        '15:30' => '03:30 PM',
        '15:45' => '03:45 PM',

        '16:00' => '04:00 PM',
        '16:15' => '04:15 PM',
        '16:30' => '04:30 PM',
        '16:45' => '04:45 PM',

        '17:00' => '05:00 PM',
        '17:15' => '05:15 PM',
        '17:30' => '05:30 PM',
        '17:45' => '05:45 PM',

        '18:00' => '06:00 PM',
        '18:15' => '06:15 PM',
        '18:30' => '06:30 PM',
        '18:45' => '06:45 PM',

        '19:00' => '07:00 PM',
        '19:15' => '07:15 PM',
        '19:30' => '07:30 PM',
        '19:45' => '07:45 PM',

        '20:00' => '08:00 PM',
        '20:15' => '08:15 PM',
        '20:30' => '08:30 PM',
        '20:45' => '08:45 PM',

        '21:00' => '09:00 PM',
        '21:15' => '09:15 PM',
        '21:30' => '09:30 PM',
        '21:45' => '09:45 PM',

        '22:00' => '10:00 PM',
        '22:15' => '10:15 PM',
        '22:30' => '10:30 PM',
        '22:45' => '10:45 PM',

        '23:00' => '11:00 PM',
        '23:15' => '11:15 PM',
        '23:30' => '11:30 PM',
        '23:45' => '11:45 PM',
    ),
];