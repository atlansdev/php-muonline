<?php
namespace MuOnline\Item;

class Harmony
{

    use ItemSetTrait;

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $level;

    public function __construct(int $type = null, int $level = null)
    {
        $this->add($type, $level);
    }

    /**
     * @param int $type
     * @return $this
     */
    public function setType(int $type) : self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * @param int $level
     * @return $this
     */
    public function setLevel(int $level) : self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevel() : int
    {
        return $this->level;
    }

    /**
     * @param int $type
     * @param int $level
     * @return $this
     */
    public function add(?int $type = null, ?int $level = null) : self
    {
        $this->type = $type;
        $this->level = $level;

        return $this;
    }
}