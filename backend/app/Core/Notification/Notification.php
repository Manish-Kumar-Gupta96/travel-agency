<?php

namespace App\Core\Notification;



abstract class Notification
{


    protected array $data = [];



    protected array $channels = [];





    public function __construct(
        array $data = []
    )
    {

        $this->data = $data;

    }





    /**
     * Notification Channels
     */
    abstract public function via(): array;





    /**
     * Notification Data
     */
    public function data(): array
    {

        return $this->data;

    }





    /**
     * Get Data Value
     */
    public function get(
        string $key,
        mixed $default = null
    ): mixed
    {

        return $this->data[$key]
            ??
            $default;

    }





    /**
     * Set Data
     */
    public function set(
        string $key,
        mixed $value
    ): static
    {

        $this->data[$key] =
            $value;


        return $this;

    }





    /**
     * Add Channel
     */
    public function addChannel(
        string $channel
    ): static
    {

        $this->channels[] =
            $channel;


        return $this;

    }





    /**
     * Channels List
     */
    public function channels(): array
    {

        return !empty($this->channels)

            ?

            $this->channels

            :

            $this->via();

    }





    /**
     * Notification Title
     */
    protected string $title = '';





    /**
     * Notification Message
     */
    protected string $message = '';





    /**
     * Set Title
     */
    public function title(
        string $title
    ): static
    {

        $this->title = $title;


        return $this;

    }





    /**
     * Get Title
     */
    public function getTitle(): string
    {

        return $this->title;

    }





    /**
     * Set Message
     */
    public function message(
        string $message
    ): static
    {

        $this->message = $message;


        return $this;

    }





    /**
     * Get Message
     */
    public function getMessage(): string
    {

        return $this->message;

    }





    /**
     * Notification Priority
     */
    protected string $priority = 'normal';





    /**
     * Set Priority
     */
    public function priority(
        string $level
    ): static
    {

        $this->priority = $level;


        return $this;

    }





    /**
     * Get Priority
     */
    public function getPriority(): string
    {

        return $this->priority;

    }





    /**
     * Convert Notification
     */
    public function toArray(): array
    {

        return [

            'title' =>
                $this->title,

            'message' =>
                $this->message,

            'data' =>
                $this->data,

            'priority' =>
                $this->priority,

            'channels' =>
                $this->channels()

        ];

    }





    /**
     * Serialize Notification
     */
    public function serialize(): string
    {

        return serialize(

            $this

        );

    }





    /**
     * Restore Notification
     */
    public static function restore(
        string $data
    ): static
    {

        return unserialize(

            $data

        );

    }


}
