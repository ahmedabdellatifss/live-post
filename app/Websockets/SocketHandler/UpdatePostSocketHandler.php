<?php

namespace App\Websockets\SocketHandler;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\PostRepository;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class UpdatePostSocketHandler extends BaseSocketHandler implements MessageComponentInterface
{


    public function onMessage(ConnectionInterface $connection, MessageInterface $msg)
    {

        $body = collect(json_decode($msg->getPayload(), true));

        $payload = $body->get('payload');

        $id = $body->get('id');

        dump($payload, $id);

        $post = Post::query()->findOrFail($id);
        $repo = new PostRepository();

        $updated = $repo->update($post, $payload);

        $response = (new PostResource($updated))->toJson();

        $connection->send($response);

        // TODO: Implement onMessage() method.
    }
}
