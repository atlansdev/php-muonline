<?php
namespace MuOnline\Util;

trait BoolValueTrait
{

    /**
     * @var bool
     */
    private $value;


    /**
     * @param bool $value
     * @return $this
     */
    public function set(bool $value = false): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function has(): bool
    {
        return $this->value ?? false;
    }

    /**
     * @return $this
     */
    public function add(): self
    {
        $this->set(true);

        return $this;
    }

}