<?php 
namespace App;


class Helper
{

    public static function isNubanValid($input = '')
    {

        $nuban = str_split($input);

        $total = ($nuban[0] * 3) + ($nuban[1] * 7) + ($nuban[2] * 3) + ($nuban[3] * 3) + ($nuban[4] * 7) + ($nuban[5] * 3) + ($nuban[6] * 3) + ($nuban[7] * 7) + ($nuban[8] * 3) + ($nuban[9] * 3) + ($nuban[10] * 7) + ($nuban[11] * 3);

        $check_digit = (10 - ($total % 10)) == 10 ? 0 : (10 - ($total % 10));

        if ($check_digit != $nuban[12])
            return false;

        return true;
    }



    public static function toPhone($string = '')
    {
        return '234' . substr($string, -10);
    }

    public static function toDate($dateString = '', $time = true)
    {

        if ($time == false)
            return date('M d, Y', strtotime($dateString));

        return date('M d, Y g:i A', strtotime($dateString));
    }

    public static function toCurrency($amount = 0)
    {

        return '&#8358;' . number_format($amount, 2);
    }

    public static function toShortNumber($number = 0)
    {
        if ($number > 1000000)
            return round($number / 1000000, 2) . 'M';

        if ($number > 1000)
            return round($number / 1000, 1) . 'K';

        return round($number, 1);
    }


    public static function uploadImageToCloudinary($image, $folder = 'product_images')
    {
        try {
            $public_id  = str_random(7);

            $response   = \Cloudinary\Uploader::upload($image, [

                'public_id' => $public_id,
                'folder'    => $folder
            ]);

            return (object)['public_id' => $public_id, 'link' => $response['secure_url']];
        } catch (Exception $e) {

            return (object)['public_id' => $public_id, 'link' => null];
        }
    }

    public static function removeProductImageFromCloudinary($public_id = '')
    {

        try {

            $result = \Cloudinary\Uploader::destroy('product_images/' . $public_id, $options = array());

            if ($result['result'] != 'ok')
                return false;

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}