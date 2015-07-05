<?php namespace Nord\Lumen\ImageManager\Adapters\Cloudinary;

class CloudinaryImageTransformation
{

    const CROP_SCALE               = 'scale';
    const CROP_FILL                = 'fill';
    const CROP_LFILL               = 'fill';
    const CROP_FIT                 = 'fit';
    const CROP_MFIT                = 'mfit';
    const CROP_LIMIT               = 'limit';
    const CROP_PAD                 = 'pad';
    const CROP_MPAD                = 'mpad';
    const CROP_CROP                = 'crop';
    const CROP_THUMB               = 'thumb';
    const GRAVITY_NW               = 'north_west';
    const GRAVITY_N                = 'north';
    const GRAVITY_NE               = 'north_east';
    const GRAVITY_W                = 'west';
    const GRAVITY_CENTER           = 'center';
    const GRAVITY_E                = 'east';
    const GRAVITY_SW               = 'south_west';
    const GRAVITY_S                = 'south';
    const GRAVITY_SE               = 'south_east';
    const GRAVITY_XY               = 'xy_center';
    const GRAVITY_FACE             = 'face';
    const GRAVITY_FACES            = 'faces';
    const GRAVITY_FACE_CENTER      = 'face:center';
    const GRAVITY_FACES_CENTER     = 'faces:center';
    const GRAVITY_CUSTOM           = 'custom';
    const RADIUS_MAX               = 'max';
    const ANGLE_AUTO_RIGHT         = 'auto_right';
    const ANGLE_AUTO_LEFT          = 'auto_left';
    const ANGLE_EXIF               = 'exif';
    const ANGLE_VFLIP              = 'vflip';
    const ANGLE_HFLIP              = 'hflip';
    const EFFECT_GRAYSCALE         = 'grayscale';
    const EFFECT_BLACKWHITE        = 'blackwhite';
    const EFFECT_OIL_PAINT         = 'oil_paint';
    const EFFECT_NEGATE            = 'negate';
    const EFFECT_VIGETTE           = 'vigette';
    const EFFECT_SEPIA             = 'sepia';
    const EFFECT_BRIGHTNESS        = 'brightness';
    const EFFECT_AUTO_BRIGHTNESS   = 'auto_brightness';
    const EFFECT_FILL_LIGHT        = 'fill_light';
    const EFFECT_SATURATION        = 'saturation';
    const EFFECT_HUE               = 'hue';
    const EFFECT_PIXELATE          = 'pixelate';
    const EFFECT_PIXELATE_REGION   = 'pixelate_region';
    const EFFECT_PIXELATE_FACES    = 'pixelate_faces';
    const EFFECT_GRADIENT_FADE     = 'gradient_fade';
    const EFFECT_BLUR              = 'blur';
    const EFFECT_BLUR_REGION       = 'blur_region';
    const EFFECT_BLUR_FACES        = 'blur_faces';
    const EFFECT_SHARPEN           = 'sharpen';
    const EFFECT_UNSHARP_MASK      = 'unsharp_mask';
    const EFFECT_CONTRAST          = 'constrast';
    const EFFECT_AUTO_CONTRAST     = 'auto_constrast';
    const EFFECT_VIBRANCE          = 'vibrance';
    const EFFECT_RED               = 'red';
    const EFFECT_GREEN             = 'green';
    const EFFECT_BLUE              = 'blue';
    const EFFECT_AUTO_COLOR        = 'auto_color';
    const EFFECT_IMPROVE           = 'improve';
    const EFFECT_SCREEN            = 'screen';
    const EFFECT_MULTIPLY          = 'multiply';
    const EFFECT_MAKE_TRANSPARENT  = 'make_transparent';
    const EFFECT_TRIM              = 'trim';
    const EFFECT_SHADOW            = 'shadow';
    const FLAG_KEEP_IPTC           = 'keep_iptc';
    const FLAG_ATTACHMENT          = 'attachment';
    const FLAG_RELATIVE            = 'relative';
    const FLAG_REGION_RELATIVE     = 'region_relative';
    const FLAG_PROGRESSIVE         = 'progressive';
    const FLAG_PNG8                = 'png8';
    const FLAG_FORCE_STRIP         = 'force_strip';
    const FLAG_CUTTER              = 'cutter';
    const FLAG_CLIP                = 'clip';
    const FLAG_AWEBP               = 'awebp';
    const FLAG_LAYER_APPLY         = 'layer_apply';
    const FLAG_IGNORE_ASPECT_RATIO = 'ignore_aspect_ratio';

    /**
     * @var string
     */
    public $crop;

    /**
     * @var integer|float
     */
    public $width;

    /**
     * @var integer|float
     */
    public $height;

    /**
     * @var string
     */
    public $gravity;

    /**
     * @var integer
     */
    public $x;

    /**
     * @var integer
     */
    public $y;

    /**
     * @var integer
     */
    public $quality;

    /**
     * @var integer|string
     */
    public $radius;

    /**
     * @var integer|string
     */
    public $angle;

    /**
     * @var string
     */
    public $effect;

    /**
     * @var integer
     */
    public $opacity;

    /**
     * @var string
     */
    public $border;

    /**
     * @var string
     */
    public $background;

    /**
     * @var string
     */
    public $overlay;

    /**
     * @var string
     */
    public $underlay;

    /**
     * @var string
     */
    public $defaultImage;

    /**
     * @var integer
     */
    public $page;

    /**
     * @var integer
     */
    public $density;

    /**
     * @var string
     */
    public $format;

    /**
     * @var array
     */
    public $flags;

    /**
     * @var string
     */
    public $transformation;


    /**
     * CloudinaryImageTransformation constructor.
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
     * @return array
     */
    public function getFlags()
    {
        return implode('.', $this->flags);
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
