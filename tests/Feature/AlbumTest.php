<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use  App\Http\Controllers\AlbumController;

class AlbumTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testApplication()
    {
        $this->withoutMiddleware();
        $response = $this->call('GET', '/album');

        $this->assertEquals(200, $response->status());
    }


    public function testIndexPage()
    {
        $this->withoutMiddleware();
        $response = $this->get('/album');
        $response->assertViewHas('albums', $value = null);

    }

    public function testRedirect()
    {
        $this->withoutMiddleware();
        $response = $this->get('/');
        $response->assertRedirect('/album');
    }
  public function testAuthRedirect()
    {
        $response = $this->get('/album');
        $response->assertRedirect('/login');
    }

    public function testDetailsPage()
    {
        $this->withoutMiddleware();
        $album = factory(\App\Model\Album::class)->create();
        $response = $this->call('GET', '/album/'. $album->id);
        $response->assertViewHas('images', $value = null);
        $this->assertEquals(200, $response->status());
    }

    public function testErrorPage()
    {
        $this->withoutMiddleware();
        $album = factory(\App\Model\Album::class)->create();
        $response = $this->call('GET', '/'. $album->id);
        $this->assertEquals(404, $response->status());
    }

    public function testEditPage()
    {
        $this->withoutMiddleware();
        $album = factory(\App\Model\Album::class)->create();
        $response = $this->call('GET', '/album/'. $album->id.'/edit');

        $this->assertEquals(200, $response->status());
        $response->assertViewHas('album', $value = null);
    }

    public function testCreateAlbum()
    {
        $this->withoutMiddleware();
        $albumAttributes = array(
            'title' =>'Test',
            'description'=>'test description'
        );
        $response = $this->get('/album/create',$albumAttributes);

        // Get the new $album ID
        $album = \App\Model\Album::latest()->first();
        $this->assertEquals(200, $response->status());
    }

//    public function testDeleteAlbum()
//    {
//        $album = factory(\App\Model\Album::class)->create();
//        $this->withoutMiddleware();
//        var_dump($album->id);
////        $response =  $this->call('POST', 'AlbumController',['id'=>$album->id]);
//        $response =  $this->call('POST', '/album/'.$album->id);
////        $response->assertRedirect('/album');
//        $this->assertEquals(302, $response->getStatusCode());
//
////        $this->notSeeInDatabase('album', ['deleted_at' => null, 'id' => $album->id]);
//    }
}
