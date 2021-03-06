<?php

class NumericArrayIterator implements Iterator
{
	protected $a;
	protected $i;

	public function __construct($a)
	{
		echo __METHOD__ . "\n";
		$this->a = $a;
	}

	public function rewind()
	{
		echo __METHOD__ . "\n";
		$this->i = 0;
	}

	public function valid()
	{
		$ret = $this->i < count($this->a);
		echo __METHOD__ . '(' . ($ret ? 'true' : 'false') . ")\n";
		return $ret;
	}

	public function key()
	{
		echo __METHOD__ . "\n";
		return $this->i;
	}

	public function current()
	{
		echo __METHOD__ . "\n";
		return $this->a[$this->i];
	}

	public function next()
	{
		echo __METHOD__ . "\n";
		$this->i++;
	}
}

class SeekableNumericArrayIterator extends NumericArrayIterator implements SeekableIterator
{
	public function seek($index)
	{
		if ($index < count($this->a)) {
			$this->i = $index;
		}
		echo __METHOD__ . '(' . $index . ")\n";
	}
}

$a = array(1, 2, 3, 4, 5);
foreach (new LimitIterator(new NumericArrayIterator($a), 1, 3) as $v)
{
	print "$v\n";
}

echo "===SEEKABLE===\n";
$a = array(1, 2, 3, 4, 5);
foreach(new LimitIterator(new SeekableNumericArrayIterator($a), 1, 3) as $v)
{
	print "$v\n";
}

echo "===SEEKING===\n";
$a = array(1, 2, 3, 4, 5);
$l = new LimitIterator(new SeekableNumericArrayIterator($a));
for($i = 1; $i < 4; $i++)
{
	$l->seek($i);
	print $l->current() . "\n";
}

echo "===DONE===\n";
