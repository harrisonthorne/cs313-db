<?php
function get_database() {
    $data_base = NULL;

    try {
        $url = getenv('DATABASE_URL');

        if( !isset($url) || empty($url) ) {
            $url = "postgres://postgres:postgres@localhost:5432/public";
        } 

        $opts = parse_url($url);
        $port = $opts["port"];
        $host = $opts["host"];
        $user = $opts["user"];
        $pass = $opts["pass"];
        $name = ltrim($opts["path"], '/');

        $data_base = new PDO("pgsql:host=$host;port=$port;dbname=$name", $user, $pass);
        $data_base->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    } catch (PDOException $e) {
        echo "There was an error connecting to the database: $e->getMessage()";
        die();
    }

    return $data_base;
}
?>
