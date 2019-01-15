<?php


function resize_single($name, $data, $width, $height, $filters) {
    $result = [];
    $filters = ($filters !== NULL) ? $filters: ["FILTER_UNDEFINED"];
    foreach($filters as $filter) {
        $result[] = resize_single_filter($name, $data, $width, $height, $filter);
    }
    return $result;
}

function resize_single_filter($name, $data, $width, $height, $filter) {
    $f = getImagickFilter($filter);
    $image = createImageFromDataUrl($data);    
    $time_start = microtime(true); 
    $image_resized = resizeImage(
        $image, 
        $width, 
        $height, 
        $f);            
    $time_end = microtime(true); 
    $execution_time = ($time_end - $time_start) * 1000;

    $result = [
        'name'      => createNewName($name, $image, $width, $height, $filter),
        'src'       => toDataUrl($image_resized->getImageBlob()),
        'width'     => $image_resized->width,
        'height'    => $image_resized->height,
        'filter'    => $filter,
        'size'      => $image_resized->getImageLength()/1024,
        'time'      => $execution_time,
        'stored'    => false
    ];
    
    return $result;
}

function resize_multiple($name, $image, $dw, $dh, $filters) {
    $W = 1080;
    $H = 1080;
    
    $result = [];
    $i = 0;
    for($h = $dh; $h <= $H; $h += $dh) {
        for($w = $dw; $w <= $W; $w += $dw) {
            $result = array_merge($result, resize_single($name, $image, $w, $h, array($filters)));
        }
    }
    return $result;
}

/**
 * Creates an imagick imgae object from the data url.
 * 
 * @param  string $data The complete data url 
 * @return imagick An imagick object created from the given data url
 */
function createImageFromDataUrl($data_url) {
    // Extract data from data url
    $imageData = explode("base64,", $data_url)[1];
    
    // Create a blob by base64-decoding of data 
    $imageBlob = base64_decode($imageData);
    // Create a imagick object by reading the image blob
    $im = new Imagick();
    $im->readImageBlob($imageBlob);
    // Return the newly created imagick object
    return $im;
}

function getImagickFilter($filter) {
    switch($filter) {
        case 'FILTER_POINT': return imagick::FILTER_POINT;
        case 'FILTER_BOX': return imagick::FILTER_BOX;
        case 'FILTER_TRIANGLE': return imagick::FILTER_TRIANGLE;
        case 'FILTER_HERMITE': return imagick::FILTER_HERMITE;
        case 'FILTER_HANNING': return imagick::FILTER_HANNING;
        case 'FILTER_HAMMING': return imagick::FILTER_HAMMING;
        case 'FILTER_BLACKMAN': return imagick::FILTER_BLACKMAN;
        case 'FILTER_GAUSSIAN': return imagick::FILTER_GAUSSIAN;
        case 'FILTER_QUADRATIC': return imagick::FILTER_QUADRATIC;
        case 'FILTER_CUBIC': return imagick::FILTER_CUBIC;
        case 'FILTER_CATROM': return imagick::FILTER_CATROM;
        case 'FILTER_MITCHELL': return imagick::FILTER_MITCHELL;
        case 'FILTER_LANCZOS': return imagick::FILTER_LANCZOS;
        case 'FILTER_BESSEL': imagick::FILTER_BESSEL;
        case 'FILTER_SINC': imagick::FILTER_SINC;
        case null:
        case '':
        case 'FILTER_UNDEFINED':
        default: return imagick::FILTER_UNDEFINED;
    }
}


function resizeImage($im, $width, $height, $filter) {
    $blur = 0.0;
    //$im->optimizeImageLayers();
    $im->setImageCompression(Imagick::COMPRESSION_JPEG);
    $im->setImageCompressionQuality(80);
    $im->resizeImage(
        $width, 
        $height, 
        $filter, 
        $blur, 
        false, 
        false
    );
    //$im->scaleImage($width, $height, true);
    //$im->cropThumbnailImage($width, $height);
    return $im;
}

function cropThumbnailImage($im, $width, $height) {
    $im->optimizeImageLayers();
    // Compression and quality
    $im->setImageCompression(Imagick::COMPRESSION_JPEG);
    $im->setImageCompressionQuality(80);
    $im->cropThumbnailImage($width, $height);
    
    return $im;
}

function toDataUrl($blob) {
    return 'data:image/jpeg;base64,' . base64_encode($blob);
}

function storeImageInDatabase($pdo, $data, $mime, $width, $height, $name) {
    $query = "INSERT INTO images(name, width, height, data) VALUES (:name, :width, :height, :data)";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':width', $width);
    $stmt->bindParam(':height', $height);
    $stmt->bindParam(':data', $data, PDO::PARAM_LOB);
    $result = $stmt->execute();
    
    return toDataUrl($data);
}

function report_error($message) {
    http_response_code(400);
    echo 'Error during server#resize: ' . $message;
}

function createNewName($name, $image, $width, $height, $filter){
    $pInfo = pathinfo($name);
    
    $new_name = implode('_', [$pInfo['filename'], $width, $height, $filter]);
    $new_name .= '.' . $pInfo['extension'];
    
    return $new_name;
}

function getImageFromDB($name) {
    $pdo = getPDO();
    $query = "SELECT * FROM image WHERE name='$name'";

    $erg = $pdo->query($query);
    $result = $erg->fetch(PDO::FETCH_OBJ);
    return $result;
}


?>