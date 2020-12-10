<?php


abstract class Service
{
    private $error;
    private $success;

    public function __construct()
    {
        $this->error = null;
        $this->success = null;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError(string $error): void
    {
        $this->error = $error;
    }

    /**
     * @return string|null
     */
    public function getSuccess(): ?string
    {
        return $this->success;
    }

    /**
     * @param string $success
     */
    public function setSuccess(string $success): void
    {
        $this->success = $success;
    }
}