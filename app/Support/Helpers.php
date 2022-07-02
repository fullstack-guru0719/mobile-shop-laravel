<?php

use App\Models\Admin\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

function navactive($currenturl)
{
  if (Request::path() === $currenturl) {
    return 'nav-link active';
  }
  return 'nav-link';
}

function fileUpload($path, $field, $hasfile, $default = '', $type = '')
{
  switch ($type) {
    case 'S3':
      # code...
      break;

    default:

      $destinationPath = $path;
      if ($hasfile) {
        if ($field->isValid()) {
          $filename = $field->getClientOriginalName();
          $extension = $field->getClientOriginalExtension();
          $file = $destinationPath . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '_' . Carbon::now()->format('Ymdhis') . '.' . $extension;
          $field->move($destinationPath, $file);
        }
      } else {
        $file = $default;
      }
      return isset($file) ? $file : '';

      break;
  }
}

function resizeFileUpload($path, $field, $hasfile, $width, $small_default = '', $default = '', $type = '')
{
  switch ($type) {
    case 'S3':
      if ($hasfile) {
        if ($field->isValid()) {
          $imgproperties = getimagesize($field);
          $smallwidth = $width;
          $smallheight = ($imgproperties[0] / $imgproperties[1]) * $smallwidth;
          $filename = $field->getClientOriginalName();
          $extension = $field->getClientOriginalExtension();
          $file = $path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension;

          $small = Image::make($field->getRealPath())->resize($smallheight, $smallwidth);
          $imgsmall = $small->stream();

          $full = Image::make($field->getRealPath());
          $imgfull = $full->stream();
          Storage::disk('s3')->put($path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension, $imgsmall->__toString(), 'public');
          Storage::disk('s3')->put($path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension, $imgfull->__toString(), 'public');

          return [
            'small' => Storage::cloud()->url($path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension),
            'full' => Storage::cloud()->url($path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension)
          ];
        }
      } else {
        $file = $default;
      }
      return isset($file) ? $file : '';
      break;

    default:

      $destinationPath = public_path() . '/' . $path;
      if ($hasfile) {
        if ($field->isValid()) {
          $imgproperties = getimagesize($field);
          $smallwidth = $width;
          $smallheight = ($imgproperties[0] / $imgproperties[1]) * $smallwidth;
          $filename = $field->getClientOriginalName();
          $extension = $field->getClientOriginalExtension();
          $file = $destinationPath . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension;

          $small = Image::make($field->getRealPath())->resize($smallheight, $smallwidth);
          $small->save($destinationPath . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension, 100);
          $field->move($destinationPath, $file);

          return [
            'small' => $path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension,
            'full' => $path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension
          ];
        }
      } else {
        $smallfile = $small_default;
        $file = $default;
      }
      return [
        'small' => isset($smallfile) ? $smallfile : '',
        'full' => isset($file) ? $file : ''
      ];

      break;
  }
}

function productFileUpload($path, $field, $hasfile, $width, $small_default = '', $default = '', $type = '')
{
  switch ($type) {
    case 'S3':
      if ($hasfile) {
        if ($field->isValid()) {
          $imgproperties = getimagesize($field);
          $smallwidth = $width;
          $smallheight = ($imgproperties[0] / $imgproperties[1]) * $smallwidth;
          $filename = $field->getClientOriginalName();
          $extension = $field->getClientOriginalExtension();
          $file = $path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension;

          $small = Image::make($field->getRealPath())->resize($smallheight, $smallwidth);
          $imgsmall = $small->stream();

          $full = Image::make($field->getRealPath());
          $imgfull = $full->stream();
          Storage::disk('s3')->put($path . '/thumb/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension, $imgsmall->__toString(), 'public');
          Storage::disk('s3')->put($path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension, $imgfull->__toString(), 'public');

          return [
            'small' => Storage::cloud()->url($path . '/thumb/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '_small.' . $extension),
            'full' => Storage::cloud()->url($path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension)
          ];
        }
      } else {
        $file = $default;
      }
      return isset($file) ? $file : '';
      break;

    default:

      $destinationPath = public_path() . '/' . $path;
      if ($hasfile) {
        if ($field->isValid()) {
          $imgproperties = getimagesize($field);
          $smallwidth = $width;
          $smallheight = ($imgproperties[0] / $imgproperties[1]) * $smallwidth;
          $filename = $field->getClientOriginalName();
          $extension = $field->getClientOriginalExtension();
          $file = $destinationPath . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension;

          $small = Image::make($field->getRealPath())->resize($smallheight, $smallwidth);
          $small->save($destinationPath . '/thumb/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension, 100);
          $field->move($destinationPath, $file);

          return [
            'small' => $path . '/thumb/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension,
            'full' => $path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension
          ];
        }
      } else {
        $smallfile = $small_default;
        $file = $default;
      }
      return [
        'small' => isset($smallfile) ? $smallfile : '',
        'full' => isset($file) ? $file : ''
      ];

      break;
  }
}

function multipleFileUpload($path, $fields, $hasfile, $width, $small_default = '', $default = '', $type = '')
{
  switch ($type) {
    case 'S3':
      if ($hasfile) {
        $photos = [];
        foreach ($fields as $field) {
          if ($field->isValid()) {
            $imgproperties = getimagesize($field);
            $smallwidth = $width;
            $smallheight = ($imgproperties[0] / $imgproperties[1]) * $smallwidth;
            $filename = $field->getClientOriginalName();
            $extension = $field->getClientOriginalExtension();
            $file = $path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension;

            $small = Image::make($field->getRealPath())->resize($smallheight, $smallwidth);
            $imgsmall = $small->stream();

            $full = Image::make($field->getRealPath());
            $imgfull = $full->stream();
            Storage::disk('s3')->put($path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension, $imgsmall->__toString(), 'public');
            Storage::disk('s3')->put($path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension, $imgfull->__toString(), 'public');

            $photos[] = [
              'small' => Storage::cloud()->url($path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension),
              'full' => Storage::cloud()->url($path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension)
            ];
          }
        }
        return $photos;
      }
      break;

    default:

      $destinationPath = public_path() . '/' . $path;
      if ($hasfile) {
        $photos = [];
        foreach ($fields as $field) {
          if ($field->isValid()) {
            $imgproperties = getimagesize($field);
            $smallwidth = $width;
            $smallheight = ($imgproperties[0] / $imgproperties[1]) * $smallwidth;
            $filename = $field->getClientOriginalName();
            $extension = $field->getClientOriginalExtension();
            $file = $destinationPath . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension;

            $small = Image::make($field->getRealPath())->resize($smallheight, $smallwidth);
            $small->save($destinationPath . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension, 100);
            $field->move($destinationPath, $file);

            $photos[] = [
              'small' => $path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension,
              'full' => $path . '/' . pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME) . '.' . $extension
            ];
          }
        }
        return $photos;
      }

      break;
  }
}

function writeClass($cssname, $content)
{
  $path = "css/pages";
  File::put(public_path($path . '/' . $cssname . '.css'), '');
  $current = File::get(public_path($path . '/' . $cssname . '.css'));
  $fp = fopen($path . '/' . $cssname . '.css', 'w');
  fwrite($fp, '');
  fwrite($fp, $current . $content);
  fclose($fp);
}

function convertYoutube($string)
{
  $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
  $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

  if (preg_match($longUrlRegex, $string, $matches)) {
    $youtube_id = $matches[count($matches) - 1];
  }

  if (preg_match($shortUrlRegex, $string, $matches)) {
    $youtube_id = $matches[count($matches) - 1];
  }
  return 'https://www.youtube.com/embed/' . $youtube_id;
}

/**
 * Get the right the 10 digit phone
 * number for easypost
 * 
 * @param string phone_number
 * 
 * @return string
 */
function easypost_phone_format(string $phone_number)
{
  $phone_number = str_replace(["-", " "], "", $phone_number);
  $phone_number = strrev($phone_number);
  $phone_number = Str::limit($phone_number, 10, "");
  $phone_number = strrev($phone_number);
  return $phone_number;
}

function replaceSMSPlaceHolder($content, Order $order)
{
  return str_replace(
    [
      '{customer_name}',
      '{customer_email}',
      '{customer_password}',
      '{order_shipping_label}',
      '{order_tracking_number}',
      '{order_tracking_link}',
      '{order_no}'
    ],
    [
      $order['customer']['fullname'],
      $order['customer']['email'],
      app('App\Http\Controllers\GlobalFunctionController')->decrypt($order['customer']['authtoken']),
      url('order/' . $order['hashedId'] . '/shippinglabel'),
      $order['tracking_code'],
      $order->shipping_tracker,
      $order['order_no']
    ],
    $content
  );
}
