<?php
namespace B55\gpb\Entity;

class Tag
{
    protected $name;
    protected $url;
    protected $tarball;

    public function __construct($name, $url, $tarball) {
        $this->name = $name;
        $this->url = $url;
        $this->tarball = $tarball;
    }

    public function getName() {
        return $this->name;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getTarball() {
        return $this->tarball;
    }
}
