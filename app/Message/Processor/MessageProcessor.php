<?php
namespace App\Message\Processor;


use App\Message\MessageRepository;

class MessageProcessor implements Processor
{
    /**
     * @var MessageRepository
     */
    public $repository;

    /**
     * @param MessageRepository $repository
     */
    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }


}