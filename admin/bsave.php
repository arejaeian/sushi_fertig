<?php
include( "../inc/funktionen.php" );

// Allowed origins to upload images, wenn online dann muss hinzugefügt werden die URL!!
$accepted_origins = array( "http://localhost", "http://127.0.0.1" );

// Images upload path
$imageFolder = "../edi_img/";

reset( $_FILES );

$temp = current( $_FILES );
if ( is_uploaded_file( $temp[ 'tmp_name' ] ) ) {
  if ( isset( $_SERVER[ 'HTTP_ORIGIN' ] ) ) {
    // Same-origin requests won't set an origin. If the origin is set, it must be valid.
    if ( in_array( $_SERVER[ 'HTTP_ORIGIN' ], $accepted_origins ) ) {
      header( 'Access-Control-Allow-Origin: ' . $_SERVER[ 'HTTP_ORIGIN' ] );
    } else {
      header( "HTTP/1.1 403 Herkunft verweigert" );
      return;
    }
  }

  // Sanitize input
  if ( preg_match( "/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp[ 'name' ] ) ) {
    header( "HTTP/1.1 400 Falscher oder ungültiger Dateiname." );
    return;
  }

  // Verify extension
  if ( !in_array( strtolower( pathinfo( $temp[ 'name' ], PATHINFO_EXTENSION ) ), array( "gif", "jpg", "png" ) ) ) {
    header( "HTTP/1.1 400 Unerlaubte Erweiterung." );
    return;
  }

  // Accept upload if there was no origin, or if it is an accepted origin
  // wird ersetzt, siehe unten
  //$filetowrite = $imageFolder . $temp['name'];

  // wird ersetzt durch bild_hochladen
  //move_uploaded_file($temp['tmp_name'], $filetowrite);
  $filetowrite = bild_hochladen( $temp[ 'name' ], $temp[ 'tmp_name' ], $imageFolder );

  // Respond to the successful upload with JSON.
  echo json_encode( array( 'location' => $filetowrite ) );
} else {
  // Notify editor that the upload failed
  header( "HTTP/1.1 500 Server Error" );
}
?>