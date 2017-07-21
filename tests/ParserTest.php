<?php
	namespace Tests\DaybreakStudios\Utility\DateTimeHelpers;

	use DaybreakStudios\Utility\DateTimeHelpers\Parser;
	use PHPUnit\Framework\TestCase;

	class ParserTest extends TestCase {
		public function testGetDateTimeFromPeriodOrStringOnEmptyValue() {
			$expected = new \DateTime();
			$expected->setTimestamp($expected->getTimestamp());

			$actual = Parser::getDateTimeFromPeriodOrString(null);
			$actual->setTimestamp($expected->getTimestamp());

			$this->assertEquals($expected, $actual);
		}

		public function testGetDateTimeFromPeriodOrStringOnDateString() {
			$expected = new \DateTime();
			$expected->setTimestamp($expected->getTimestamp());

			$actual = Parser::getDateTimeFromPeriodOrString($expected->format(\DateTime::ISO8601));
			$actual->setTimestamp($actual->getTimestamp());

			$this->assertEquals($expected, $actual);
		}

		public function testGetDateTimeFromPeriodOrStringOnPeriod() {
			$expected = (new \DateTime())->sub(new \DateInterval('P1D'));
			$expected->setTimestamp($expected->getTimestamp());

			$actual = Parser::getDateTimeFromPeriodOrString('P1D');
			$actual->setTimestamp($actual->getTimestamp());

			$this->assertEquals($expected, $actual);
		}
	}