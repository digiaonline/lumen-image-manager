<?php namespace Nord\Lumen\ImageManager\Adapters\Cloudinary;

class CloudinaryUploadParameters
{

    const RESOURCE_TYPE_IMAGE              = 'image';
    const RESOURCE_TYPE_RAW                = 'raw';
    const RESOURCE_TYPE_AUTO               = 'auto';
    const TYPE_UPLOAD                      = 'upload';
    const TYPE_PUBLIC                      = 'public';
    const TYPE_AUTHENTICATED               = 'authenticated';
    const RAW_CONVERT_ASPOSE               = 'aspose';
    const CATEGORIZATION_REKOGNITION_SCENE = 'rekognition_scene';
    const DETECTION_REKOGNITION_FACE       = 'rekognition_face';
    const MODERATION_MANUAL                = 'manual';
    const MODERATION_WEBPURIFY             = 'webpurify';

    /**
     * @var string
     */
    public $publicId;

    /**
     * @var string
     */
    public $resourceType;

    /**
     * @var string
     */
    public $type;

    /**
     * @var array
     */
    public $tags;

    /**
     * @var array
     */
    public $context;

    /**
     * @var CloudinaryImageTransformation
     */
    public $transformation;

    /**
     * @var string
     */
    public $format;

    /**
     * @var string|array
     */
    public $allowedFormats;

    /**
     * @var array
     */
    public $eager;

    /**
     * @var boolean
     */
    public $eagerAsync;

    /**
     * @var string
     */
    public $proxy;

    /**
     * @var string|array
     */
    public $headers;

    /**
     * @var string
     */
    public $callback;

    /**
     * @var string
     */
    public $notificationUrl;

    /**
     * @var string
     */
    public $eagerNotificationUrl;

    /**
     * @var boolean
     */
    public $backup;

    /**
     * @var boolean
     */
    public $returnDeleteToken;

    /**
     * @var boolean
     */
    public $faces;

    /**
     * @var boolean
     */
    public $exif;

    /**
     * @var boolean
     */
    public $colors;

    /**
     * @var boolean
     */
    public $imageMetadata;

    /**
     * @var boolean
     */
    public $pHash;

    /**
     * @var boolean
     */
    public $invalidate;

    /**
     * @var boolean
     */
    public $useFilename;

    /**
     * @var boolean
     */
    public $uniqueFilename;

    /**
     * @var string
     */
    public $folder;

    /**
     * @var boolean
     */
    public $overwrite;

    /**
     * @var boolean
     */
    public $discardOriginalFilename;

    /**
     * @var string
     */
    public $faceCoordinates;

    /**
     * @var string
     */
    public $customCoordinates;

    /**
     * @var string
     */
    public $rawConvert;

    /**
     * @var string
     */
    public $categorization;

    /**
     * @var float
     */
    public $autoTagging;

    /**
     * @var string
     */
    public $detection;

    /**
     * @var string
     */
    public $moderation;

    /**
     * @var string
     */
    public $uploadPreset;

    /**
     * @var array
     */
    public $html;


    /**
     * CloudinaryUploadParameters constructor.
     *
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        foreach ($properties as $property => $value) {
            $setter = 'set' . ucfirst($properties);
            if (method_exists($this, $setter)) {
                $this->$property = $this->$setter($value);
            } else {
                $this->$property = $value;
            }
        }
    }


    /**
     * @return CloudinaryImageTransformation
     */
    public function getTransformation()
    {
        return $this->transformation->toArray();
    }


    /**
     * @return array
     */
    public function getAllowedFormats()
    {
        return implode(',', $this->allowedFormats);
    }


    /**
     * @return array
     */
    public function toArray()
    {
        $array = [];

        foreach (array_keys(get_object_vars($this)) as $property) {
            $getter = 'get' . ucfirst($property);
            if (method_exists($this, $getter)) {
                $array[snake_case($property)] = $this->$getter();
            } else {
                $array[snake_case($property)] = $this->$property;
            }
        }

        return $array;
    }
}
