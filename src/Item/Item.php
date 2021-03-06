<?php
namespace MuOnline\Item;

use MuOnline\Item\Maker\MakerFactory;
use MuOnline\Item\Parser\ParserFactory;
use MuOnline\Item\Socket\Slot as SocketSlot;
use MuOnline\Item\Excellent\Slot as ExcellentSlot;
use MuOnline\Item\File\Parser\Item\ParserFactory as FileParserFactory;
use MuOnline\Util\DirtyTrait;

class Item
{

    use DirtyTrait;

    /**
     * @var string
     */
    private $hex;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $section;

    /**
     * @var int
     */
    private $index;

    /**
     * @var int
     */
    private $level = 0;

    /**
     * @var
     */
    private $option = 0;

    /**
     * @var Luck
     */
    private $luck;

    /**
     * @var Skill
     */
    private $skill;

    /**
     * @var Durability
     */
    private $durability;

    /**
     * @var Excellent
     */
    private $excellent;

    /**
     * @var Serial
     */
    private $serial;

    /**
     * @var Ancient
     */
    private $ancient;

    /**
     * @var Refine
     */
    private $refine;

    /**
     * @var Harmony
     */
    private $harmony;

    /**
     * @var Socket
     */
    private $socket;

    /**
     * @var Mastery
     */
    private $mastery;

    /**
     * @var Time
     */
    private $time;

    /**
     * Item constructor.
     * @param int|null $section
     * @param int|null $index
     */
    public function __construct(?int $section = null, ?int $index = null)
    {
        $this->section = $section;
        $this->index = $index;
    }

    /**
     * @param string $hex
     * @return $this
     */
    public function setHex(string $hex): self
    {
        $this->hex = $hex;

        return $this;
    }

    /**
     * @param string $hex
     * @return $this
     */
    public function hex(string $hex): self
    {
        return $this->setHex($hex);
    }

    /**
     * @return string|null
     */
    public function getHex(): ?string
    {
        return $this->hex;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name(string $name): self
    {
        return $this->setName($name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param int $width
     * @return $this
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @param int $width
     * @return $this
     */
    public function width(int $width): self
    {
        return $this->setWidth($width);
    }

    /**
     * @return string
     */
    public function getWidth(): string
    {
        return $this->width;
    }

    /**
     * @param int $height
     * @return $this
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeight(): string
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return $this
     */
    public function height(int $height): self
    {
        return $this->setHeight($height);
    }

    /**
     * @param int $section
     * @return $this
     */
    public function setSection(int $section): self
    {
        $this->addDirty($this->section, $section);
        $this->section = $section;

        return $this;
    }

    /**
     * @param int $section
     * @return $this
     */
    public function section(int $section): self
    {
        return $this->setSection($section);
    }

    /**
     * @return int|null
     */
    public function getSection(): ?int
    {
        return $this->section;
    }

    /**
     * @param int $index
     * @return $this
     */
    public function setIndex(int $index): self
    {
        $this->addDirty($this->index, $index);
        $this->index = $index;

        return $this;
    }

    /**
     * @param int $index
     * @return $this
     */
    public function index(int $index): self
    {
        return $this->setIndex($index);
    }

    /**
     * @return int|null
     */
    public function getIndex(): ?int
    {
        return $this->index;
    }

    /**
     * @param int $level
     * @return $this
     */
    public function setLevel(int $level): self
    {
        $this->addDirty($this->level, $level);
        $this->level = $level;

        return $this;
    }

    /**
     * @param int $level
     * @return $this
     */
    public function level(int $level): self
    {
        return $this->setLevel($level);
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $levels
     * @return $this
     */
    public function addLevel(int $levels = 1): self
    {
        $this->setLevel($this->level + $levels);

        return $this;
    }

    /**
     * @param int $option
     * @return $this
     */
    public function setOption(int $option): self
    {
        $this->addDirty($this->option, $option);
        $this->option = $option;

        return $this;
    }

    /**
     * @param int $option
     * @return $this
     */
    public function option(int $option): self
    {
        return $this->setOption($option);
    }

    /**
     * @return int
     */
    public function getOption(): int
    {
        return $this->option;
    }

    /**
     * @param int $options
     * @return $this
     */
    public function addOption(int $options = 4): self
    {
        $this->setOption($this->option + $options);

        return $this;
    }

    /**
     * @param Luck $luck
     * @return $this
     */
    public function setLuck(Luck $luck): self
    {
        $this->luck = $luck->setItem($this);

        return $this;
    }

    /**
     * @return Luck
     */
    public function getLuck(): Luck
    {
        if (! $this->luck) {
            $this->luck = (new Luck())->setItem($this);
        }

        return $this->luck;
    }

    /**
     * @return $this
     */
    public function addLuck(): self
    {
        $this->getLuck()->add();

        return $this;
    }

    /**
     * @param Skill $skill
     * @return $this
     */
    public function setSkill(Skill $skill): self
    {
        $this->skill = $skill->setItem($this);

        return $this;
    }

    /**
     * @return Skill
     */
    public function getSkill(): Skill
    {
        if (! $this->skill) {
            $this->skill = (new Skill())->setItem($this);
        }

        return $this->skill;
    }

    /**
     * @return $this
     */
    public function addSkill(): self
    {
        $this->getSkill()->add();

        return $this;
    }

    /**
     * @param Durability|int $durability
     * @return $this
     */
    public function setDurability($durability): self
    {
        if (! $durability instanceof Durability) {
            $durability = new Durability($durability);
        }

        $this->durability = $durability->setItem($this);

        return $this;
    }

    /**
     * @param Durability|int $durability
     * @return $this
     */
    public function durability($durability): self
    {
        return $this->setDurability($durability);
    }

    /**
     * @return Durability
     */
    public function getDurability(): Durability
    {
        return $this->durability;
    }

    /**
     * @param Ancient $ancient
     * @return $this
     */
    public function setAncient(Ancient $ancient): self
    {
        $this->ancient = $ancient->setItem($this);

        return $this;
    }

    /**
     * @param Ancient $ancient
     * @return $this
     */
    public function ancient(Ancient $ancient): self
    {
        return $this->setAncient($ancient);
    }

    /**
     * @return Ancient
     */
    public function getAncient(): Ancient
    {
        if (! $this->ancient) {
            $this->ancient = (new Ancient())->setItem($this);
        }

        return $this->ancient;
    }

    /**
     * @param int $tier
     * @param int $stamina
     * @return $this
     */
    public function addAncient(int $tier, int $stamina = Ancient::STAMINA_5): self
    {
        $this->getAncient()->add($tier, $stamina);

        return $this;
    }

    /**
     * @param Serial $serial
     * @return $this
     */
    public function setSerial(Serial $serial): self
    {
        $this->serial = $serial->setItem($this);

        return $this;
    }

    /**
     * @param Serial $serial
     * @return $this
     */
    public function serial(Serial $serial): self
    {
        return $this->setSerial($serial);
    }

    /**
     * @return Serial
     */
    public function getSerial(): Serial
    {
        if (! $this->serial) {
            $this->serial = (new Serial())->setItem($this);
        }

        return $this->serial;
    }

    /**
     * @return $this
     */
    public function generateSerial(): self
    {
        $this->getSerial()->generate();

        return $this;
    }

    /**
     * @param Excellent $excellent
     * @return $this
     */
    public function setExcellent(Excellent $excellent): self
    {
        $this->excellent = $excellent->setItem($this);

        return $this;
    }

    /**
     * @param Excellent $excellent
     * @return $this
     */
    public function excellent(Excellent $excellent): self
    {
        return $this->setExcellent($excellent);
    }

    /**
     * @return Excellent
     */
    public function getExcellent(): Excellent
    {
        if (! $this->excellent) {
            $this->excellent = (new Excellent())->setItem($this);
        }

        return $this->excellent;
    }

    /**
     * @param int $index
     * @return ExcellentSlot
     */
    public function getExcellentSlot(int $index): ExcellentSlot
    {
        return $this->getExcellent()->getSlot($index);
    }

    /**
     * @param $index
     * @param ExcellentSlot|bool $slot
     * @return $this
     */
    public function addExcellentInSlot(int $index, $slot): self
    {
        if (! $slot instanceof ExcellentSlot) {
            $slot = new ExcellentSlot($slot);
        }

        $this->getExcellent()->add($index, $slot);

        return $this;
    }

    /**
     * @param Harmony $harmony
     * @return $this
     */
    public function setHarmony(Harmony $harmony): self
    {
        $this->harmony = $harmony->setItem($this);

        return $this;
    }

    /**
     * @param Harmony $harmony
     * @return $this
     */
    public function harmony(Harmony $harmony): self
    {
        return $this->setHarmony($harmony);
    }

    /**
     * @return Harmony
     */
    public function getHarmony(): Harmony
    {
        if (! $this->harmony) {
            $this->harmony = (new Harmony())->setItem($this);
        }

        return $this->harmony;
    }

    /**
     * @param int $type
     * @param int $level
     * @return $this
     */
    public function addHarmony(int $type = 0, int $level = 0): self
    {
        $this->getHarmony()->add($type, $level);

        return $this;
    }

    /**
     * @param Refine $refine
     * @return $this
     */
    public function setRefine(Refine $refine): self
    {
        $this->refine = $refine;

        return $this;
    }

    /**
     * @param Refine $refine
     * @return $this
     */
    public function refine(Refine $refine): self
    {
        return $this->setRefine($refine);
    }

    /**
     * @return Refine
     */
    public function getRefine(): Refine
    {
        if (! $this->refine) {
            $this->refine = (new Refine())->setItem($this);
        }

        return $this->refine;
    }

    /**
     * @return $this
     */
    public function addRefine(): self
    {
        $this->getRefine()->add();

        return $this;
    }

    /**
     * @param Socket $socket
     * @return $this
     */
    public function setSocket(Socket $socket): self
    {
        $this->socket = $socket->setItem($this);

        return $this;
    }

    /**
     * @param Socket $socket
     * @return $this
     */
    public function socket(Socket $socket): self
    {
        return $this->setSocket($socket);
    }

    /**
     * @return Socket
     */
    public function getSocket(): Socket
    {
        if (! $this->socket) {
            $this->socket = (new Socket())->setItem($this);
        }

        return $this->socket;
    }

    /**
     * @param int $index
     * @return SocketSlot
     */
    public function getSocketSlot(int $index): SocketSlot
    {
        return $this->getSocket()->getSlot($index);
    }

    /**
     * @param int $index
     * @param SocketSlot|bool $slot
     * @return $this
     */
    public function addSocketInSlot(int $index, $slot): self
    {
        if (! $slot instanceof SocketSlot) {
            $slot = (new SocketSlot())->parse($slot);
        }

        $this->getSocket()->add($index, $slot);

        return $this;
    }

    /**
     * @param Mastery $mastery
     * @return $this
     */
    public function setMastery(Mastery $mastery): self
    {
        $this->mastery = $mastery;

        return $this;
    }

    /**
     * @param Mastery $mastery
     * @return $this
     */
    public function mastery(Mastery $mastery): self
    {
        return $this->setMastery($mastery);
    }

    /**
     * @return Mastery
     */
    public function getMastery(): Mastery
    {
        if (! $this->mastery) {
            $this->mastery = (new Mastery())->setItem($this);
        }

        return $this->mastery;
    }

    /**
     * @param Time $time
     * @return $this
     */
    public function setTime(Time $time): self
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @param Time $time
     * @return $this
     */
    public function time(Time $time): self
    {
        return $this->setTime($time);
    }

    /**
     * @return Time
     */
    public function getTime(): Time
    {
        if (! $this->time) {
            $this->time = (new Time())->setItem($this);
        }

        return $this->time;
    }

    /**
     * @param string|null $hex
     * @param Parser|null $parser
     * @return $this
     */
    public function parse(string $hex = null, Parser $parser = null): self
    {
        if (! $hex) {
            $hex = $this->getHex();
        }

        if (! $parser) {
            $parser = ParserFactory::factory();
        }

        $parser->setHex($hex)
            ->parse($this);

        $this->sync();

        $this->addDirty();

        return $this;
    }

    /**
     * @param Maker|null $maker
     * @return string
     */
    public function make(Maker $maker = null): string
    {
        if (! $maker) {
            $maker = MakerFactory::factory();
        }

        $this->setHex($maker->make($this));

        return $this->getHex();
    }

    /**
     * @param bool $durability
     * @return $this
     */
    public function sync(bool $durability = false): self
    {
        $parser = FileParserFactory::factory();

        $parser->sync($this, $durability);

        return $this;
    }

    /**
     * @param int $section
     * @return bool
     */
    public function is(int $section): bool
    {
        return $this->section === $section;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name ?? '';
    }

}