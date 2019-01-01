<?php
ob_start("ob_gzhandler");

require_once('./utils.php');
header('Content-type:application/json;charset=utf-8');

$name = getRequestParameter('name');
$width = getRequestParameter('width');
$height = getRequestParameter('height');
$data = getRequestParameter('data');

if($data == null) {
    report_error('Invalid or empty data url');
}
else {
    $image = createImageFromDataUrl($data);    
    if($image == null) {
        report_error("Could't create image from the given data url");
    }
    else {
        if($width == null || $height == null) {
            report_error('Invalid width or height');
        }
        else {
            $image_resized = resizeImage($image, $width, $height);
            if($image_resized == null) {
                report_error("Could't resize image");
            }
            else {
                echo json_encode([
                    'url' => toDataUrl($image_resized->getImageBlob()), 
                    'stored' => false
                ]);
            }
        }
    }
}


/**
 * Creates an imagick imgae object from the data url.
 * 
 * @param  string $data The complete data url 
 * @return imagick An imagick object created from the given data url
 */
function createImageFromDataUrl($data_url) {
    // Get the myme type from data url
    $mimeType = mime_content_type($data_url);
    // Extract data from data url
    $imageData = str_replace("data:$mimeType;base64,", '', $data_url);
    // Create a blob by base64-decoding of data 
    $imageBlob = base64_decode($imageData);
    // Create a imagick object by reading the image blob
    $im = new Imagick();
    $im->readImageBlob($imageBlob);
    // Return the newly created imagick object
    return $im;
}


function resizeImage($im, $width, $height) {
    $filter = 0;
    $blur = 0.0;
    //$im->optimizeImageLayers();
    $im->resizeImage($width, $height, $filter, $blur, false, false);
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
    return 'data:image/jpg;base64,' . base64_encode($blob);
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
    echo 'Error during server#resize';
}

/*function resizeOnly($name, $width, $height, $data) {
    $im = resizeImage($name, $width, $height, $data);
    echo json_encode(['url' => toDataUrl($im->getImageBlob()), 'stored' => false]);
}*/


ob_end_flush();
?>