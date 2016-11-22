<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test basic listings.
     *
     * @return void
     */
    public function testListAndSearch()
    {
        /* test basic list all */
        $this->json('GET','/api/tasks/')
            ->seeJsonStructure([
                '*' => [
                    'id','title','body','labels'
                ]
            ]);
        /* test basic search for "task" */
        $this->json('POST','/api/tasks/search',['term'=>'task'])
            ->seeJsonStructure([
                '*' => [
                    'id','title','body','labels'
                ]
            ]);
    }

    /**
     * Test add and update task.
     *
     * @return void
     */
    public function testAddAndUpdate()
    {
        /* test additions */

        /* test valid addition (title is only thing needing checks) */
        $task = $this->json('POST','/api/tasks/',['title'=>'sampletest','labels'=>'','body'=>'']);
        $this->assertTrue(is_int(intval($task->response->getContent())));

        $id = intval($task->response->getContent());

        /* test too short of title */
        $response = $this->json('POST','/api/tasks/',['title'=>'t']);
        $response->assertResponseStatus(400);

        /* test too long of title */
        $str = "";
        for($i=0;$i<150;$i++) {
            $str .= "t";
        }
        $response = $this->json('POST','/api/tasks/',['title'=>$str]);
        $response->assertResponseStatus(400);

        /* test updates */

        /* test valid update (title is only thing needing checks) */
        $response = $this->json('PUT','/api/tasks/'.$id,['title'=>'sampletestedit']);
        $response->assertResponseOk();

        /* test too short of title */
        $response = $this->json('PUT','/api/tasks/'.$id,['title'=>'t']);
        $response->assertResponseStatus(400);

        /* test too long of title */
        $str = "";
        for($i=0;$i<150;$i++) {
            $str .= "t";
        }
        $response = $this->json('PUT','/api/tasks/'.$id,['title'=>$str]);
        $response->assertResponseStatus(400);
    }

    /**
     * Test delete task.
     *
     * @return void
     */
    public function testDelete()
    {
        /* get a new task */
        $task = $this->json('POST','/api/tasks/',['title'=>'sampletest','labels'=>'','body'=>'']);
        $id = intval($task->response->getContent());

        /* delete it */
        $response = $this->json('DELETE','/api/tasks/'.$id);
        $response->assertResponseOk();
    }
}
