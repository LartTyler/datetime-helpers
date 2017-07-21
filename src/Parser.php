<?php
	namespace DaybreakStudios\Utility\DateTimeHelpers;

	final class Parser {
		/**
		 * @param string         $value
		 * @param \DateTime|null $def
		 *
		 * @return \DateTime
		 */
		public static function getDateTimeFromPeriodOrString($value, \DateTime $def = null) {
			$value = trim($value);

			if (!$value)
				return $def ?: new \DateTime();

			$initialChar = strtoupper(substr($value, 0, 1));

			if ($initialChar === 'P' || $initialChar === '+' || $initialChar === '-') {
				if ($initialChar !== 'P')
					$period = substr($value, 1);
				else
					$period = $value;

				$date = new \DateTime();

				if ($initialChar === '+')
					$date->add(new \DateInterval($period));
				else
					$date->sub(new \DateInterval($period));

				return $date;
			}

			return new \DateTime($value);
		}
	}