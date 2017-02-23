<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AlbumTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testApplication()
    {
        $response = $this->call('GET', '/album');

        $this->assertEquals(200, $response->status());
    }


    public function testIndexPage()
    {
        $response = $this->get('/album');

        $response->assertViewHas('albums', $value = null);

    }

    public function testRedirect()
    {
        $response = $this->get('/');
        $response->assertRedirect('/album');
    }

    public function testDetailsPage()
    {
        $album = factory(\App\Model\Album::class)->create();
        $response = $this->call('GET', '/album/'. $album->id);
        $response->assertViewHas('images', $value = null);
        $this->assertEquals(200, $response->status());
    }

    public function testErrorPage()
    {
        $album = factory(\App\Model\Album::class)->create();
        $response = $this->call('GET', '/'. $album->id);
        $this->assertEquals(404, $response->status());
    }

    public function testEditPage()
    {
        $album = factory(\App\Model\Album::class)->create();
        $response = $this->call('GET', '/album/'. $album->id.'/edit');
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('album', $value = null);
    }

    public function testCreateAlbum()
    {
        $albumAttributes = array(
            'title' =>'Test',
            'description'=>'test description'
        );
        $response = $this->get('/album/create',$albumAttributes);

        // Get the new $album ID
        $album = \App\Model\Album::latest()->first();
        $this->assertEquals(200, $response->status());
    }

    public function testDeleteAlbum()
    {
        $album = factory(\App\Model\Album::class)->create();
        $response =  $this->call('DELETE', 'AlbumController@destroy',['id'=>$album->id]);
//        $response->assertRedirect('/album');
//        $this->assertEquals(302, $response->getStatusCode());

//        $this->notSeeInDatabase('album', ['deleted_at' => null, 'id' => $album->id]);
    }
}
