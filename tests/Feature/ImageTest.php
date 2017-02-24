<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Model\Image;
use App\Http\Controllers\ImageController;

class ImageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
//    public function testExample()
//    {
//        $album_id = null;
//        $file = base_path('tests/assets/img/photo.jpeg');
//        $photo = new \Illuminate\Http\UploadedFile($file, 'photo.jpeg',
//            mime_content_type($file), filesize($file), null, true);
//        $response = $this->action('POST', 'ImageController@store', [], [
//            'file' => $photo,
//            'album_id' => $album_id], [], ['photo' => $photo]);
//
//
//    }

//$response = $this->call($method, $uri, $parameters, $files, $server, $content);
    public function testRedirect()
    {
        $this->withoutMiddleware();
        $response = $this->get('/');
        $response->assertRedirect('/album');
    }

}
