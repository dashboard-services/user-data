<?php

    $ip         = $_SERVER['REMOTE_ADDR'];

    $ips_map = json_decode( file_get_contents( 'data.json', true ) );

    function get_user_info( $ip ) {
        global $ips_map;
        $username   = '';
        $name       = '';
        $lastname   = 'Grumpy';
        $avatar     = 'http://i.imgur.com/BQPhnyz.jpg';

        if( property_exists( $ips_map, $ip ) ){
            $username   = $ips_map->$ip;
            $name_split = explode('.', $username);
            $name       = ucfirst( $name_split[0] );
            $lastname   = ucfirst( $name_split[1] );
            $avatar     = 'http://keepintonic.redtonic/images/avatars/55/' . $username . '.jpg';
        }

        $info = array(
                    'ip'        => $ip,
                    'userName'  => $username,
                    'name'      => $name,
                    'lastName' =>  $lastname,
                    'avatar'    => $avatar
                );

        return $info;
    }


    $response = get_user_info( $ip );

    header('Content-Type: application/json; charset=utf-8');
    header("access-control-allow-origin: *");
    echo json_encode($response);

?>