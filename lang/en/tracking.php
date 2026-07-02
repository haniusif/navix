<?php

return [
    'meta' => [
        'title' => 'Track Your Shipment | NAVIX',
        'description' => 'Track any NAVIX shipment in real time — live status, route, and delivery timeline from warehouse to doorstep.',
    ],

    'hero' => [
        'eyebrow' => 'Shipment Tracking',
        'title_lead' => 'Track your shipment,',
        'title_accent' => 'in real time',
        'sub' => 'Enter your tracking number to see live status, route, and estimated delivery — updated to the minute.',
        'placeholder' => 'Enter tracking number (e.g. RL-419422548689)',
        'cta' => 'Track',
        'demo_hint' => 'Try a demo: :code',
    ],

    'result' => [
        'tracking_number' => 'Tracking number',
        'status' => 'Status',
        'status_in_transit' => 'In transit',
        'eta' => 'Estimated delivery',
        'eta_value' => 'Tomorrow, by 6:00 PM',
        'service' => 'Service',
        'service_value' => 'NAVIX Express',
        'from' => 'Origin',
        'from_value' => 'Riyadh Fulfillment Center',
        'to' => 'Destination',
        'to_value' => 'Jeddah, Al Hamra District',
        'weight' => 'Weight',
        'weight_value' => '4.2 kg',
        'pieces' => 'Pieces',
        'pieces_value' => '2 parcels',
        'progress' => 'Delivery progress',
        'map_title' => 'Live route',
        'map_note' => 'Vehicle location updates every 30 seconds',
        'updated' => 'Last updated just now',
        'copy' => 'Copy tracking number',
        'created' => 'Created',
        'loading' => 'Loading…',
        'empty_prompt' => 'Enter your tracking number above to see live shipment status, route, and delivery timeline.',
    ],

    'timeline' => [
        'heading' => 'Shipment timeline',
        's1_title' => 'Order placed',
        's1_desc' => 'Order received and confirmed',
        's1_time' => 'Mon · 09:12',
        's2_title' => 'Picked & packed',
        's2_desc' => 'Items picked, scanned and packed at Riyadh FC',
        's2_time' => 'Mon · 14:38',
        's3_title' => 'In transit',
        's3_desc' => 'Departed Riyadh hub — en route to Jeddah',
        's3_time' => 'Tue · 03:20',
        's4_title' => 'Out for delivery',
        's4_desc' => 'With courier for final-mile delivery',
        's4_time' => 'Expected tomorrow',
        's5_title' => 'Delivered',
        's5_desc' => 'Handed to recipient',
        's5_time' => 'Pending',
    ],

    'help' => [
        'title' => 'Need help with your shipment?',
        'sub' => 'Our support team is available 24/7 to help you track, reroute, or resolve any delivery issue.',
        'cta_primary' => 'Contact support',
        'cta_secondary' => 'View FAQ',
    ],

    // 5-step progress stages (mapped from the numeric parcel status)
    'stage_1' => 'Pending',
    'stage_2' => 'Processing',
    'stage_3' => 'In transit',
    'stage_4' => 'Out for delivery',
    'stage_5' => 'Delivered',

    'timeline_empty' => 'No tracking updates yet.',

    'errors' => [
        'not_found' => 'We couldn\'t find that tracking number. Please check and try again.',
        'generic' => 'Something went wrong while fetching your shipment. Please try again.',
    ],
];
