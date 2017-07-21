<?php
	namespace Tests\DaybreakStudios\Utility\DateTimeHelpers;

	use DaybreakStudios\Utility\DateTimeHelpers\Modifier;
	use PHPUnit\Framework\TestCase;

	class ModifierTest extends TestCase {
		public function testStartOfMinute() {
			$expected = new \DateTime();
			$expected->setTime($expected->format('H'), $expected->format('i'), 0);

			$this->assertEquals($expected, Modifier::startOf(Modifier::INTERVAL_MINUTE, new \DateTime()));
		}

		public function testStartOfHour() {
			$expected = new \DateTime();
			$expected->setTime($expected->format('H'), 0, 0);

			$this->assertEquals($expected, Modifier::startOf(Modifier::INTVERAL_HOUR, new \DateTime()));
		}

		public function testStartOfDay() {
			$expected = (new \DateTime())->setTime(0, 0, 0);

			$this->assertEquals($expected, Modifier::startOf(Modifier::INTERVAL_DAY, new \DateTime()));
		}

		public function testStartOfWeek() {
			$expected = (new \DateTime())->setTime(0, 0, 0);
			$expected->sub(new \DateInterval(sprintf('P%dD', $expected->format('w'))));

			$this->assertEquals($expected, Modifier::startOf(Modifier::INTERVAL_WEEK, new \DateTime()));
		}

		public function testStartOfMonth() {
			$expected = (new \DateTime())->setTime(0, 0, 0);
			$expected->sub(new \DateInterval(sprintf('P%dD', $expected->format('d') - 1)));

			$this->assertEquals($expected, Modifier::startOf(Modifier::INTERVAL_MONTH, new \DateTime()));
		}

		public function testStartOfYear() {
			$expected = (new \DateTime())->setTime(0, 0, 0);
			$expected->setDate((int)$expected->format('Y'), 1, 1);

			$this->assertEquals($expected, Modifier::startOf(Modifier::INTERVAL_YEAR, new \DateTime()));
		}

		public function testEndOfMinute() {
			$expected = new \DateTime();
			$expected->setTime($expected->format('H'), $expected->format('i'), 59, 999999);

			$this->assertEquals($expected, Modifier::endOf(Modifier::INTERVAL_MINUTE, new \DateTime()));
		}

		public function testEndOfHour() {
			$expected = new \DateTime();
			$expected->setTime($expected->format('H'), 59, 59, 999999);

			$this->assertEquals($expected, Modifier::endOf(Modifier::INTVERAL_HOUR, new \DateTime()));
		}

		public function testendOfDay() {
			$expected = (new \DateTime())
				->setTime(23, 59, 59, 999999);

			$this->assertEquals($expected, Modifier::endOf(Modifier::INTERVAL_DAY, new \DateTime()));
		}

		public function testEndOfWeek() {
			$expected = (new \DateTime())
				->setTime(23, 59, 59, 999999);

			$expected->add(new \DateInterval('P' . (6 - (int)$expected->format('w')) . 'D'));

			$this->assertEquals($expected, Modifier::endOf(Modifier::INTERVAL_WEEK, new \DateTime()));
		}

		public function testEndOfMonth() {
			$expected = (new \DateTime())
				->setTime(23, 59, 59, 999999);

			$expected
				->add(new \DateInterval('P1M'))
				->sub(new \DateInterval('P' . (int)$expected->format('d') . 'D'));

			$this->assertEquals($expected, Modifier::endOf(Modifier::INTERVAL_MONTH, new \DateTime()));
		}

		public function testEndOfYear() {
			$expected = (new \DateTime())
				->setTime(23, 59, 59, 999999);

			$expected->setDate((int)$expected->format('Y'), 12, 31);

			$this->assertEquals($expected, Modifier::endOf(Modifier::INTERVAL_YEAR, new \DateTime()));
		}

		public function testWithoutMicrosecondsWithoutArgument() {
			$expected = new \DateTime();
			$expected->setTimestamp($expected->getTimestamp());

			$this->assertEquals($expected, Modifier::withoutMicroseconds());
		}

		public function testWithoutMicroseconds() {
			$expected = new \DateTime();
			$acutal = Modifier::withoutMicroseconds(clone $expected);

			$expected->setTimestamp($expected->getTimestamp());

			$this->assertEquals($expected, $acutal);
		}
	}