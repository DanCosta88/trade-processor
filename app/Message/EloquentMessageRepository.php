<?php
namespace App\Message;

use App\Repositories\EloquentRepository;

class EloquentMessageRepository extends EloquentRepository implements MessageRepository
{

    protected $model;

    /**
     * @param Message $model
     */
    public function __construct(Message $model)
    {
        $this->model = $model;
    }

}