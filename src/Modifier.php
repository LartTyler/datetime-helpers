<?php
	namespace DaybreakStudios\Utility\DateTimeHelpers;

	final class Modifier {
		const INTERVAL_MINUTE = 'minute';
		const INTVERAL_HOUR = 'hour';
		const INTERVAL_DAY = 'day';
		const INTERVAL_WEEK = 'week';
		const INTERVAL_MONTH = 'month';
		const INTERVAL_YEAR = 'year';

		/**
		 * @param string         $interval one of the INTERVAL_* class constants
		 * @param \DateTime|null $date
		 *
		 * @return \DateTime
		 */
		public static function startOf($interval, \DateTime $date = null) {
			$date = $date ?: new \DateTime();

			switch ($interval) {
				case self::INTERVAL_MINUTE:
					$date->setTime((int)$date->format('H'), (int)$date->format('i'), 0, 0);

					break;

				case self::INTVERAL_HOUR:
					$date->setTime((int)$date->format('H'), 0, 0, 0);

					break;

				case self::INTERVAL_DAY:
					$date->setTime(0, 0, 0, 0);

					break;

				case self::INTERVAL_WEEK:
					$date
						->sub(new \DateInterval('P' . (int)$date->format('w') . 'D'))
						->setTime(0, 0, 0, 0);

					break;

				case self::INTERVAL_MONTH:
					$date
						->sub(new \DateInterval('P' . ((int)$date->format('d') - 1) . 'D'))
						->setTime(0, 0, 0, 0);

					break;

				case self::INTERVAL_YEAR:
					$date
						->setTime(0, 0, 0, 0)
						->setDate((int)$date->format('Y'), 1, 1);

					break;

				default:
					throw new \InvalidArgumentException('$interval must be one of the INTERVAL_* class constants');
			}

			return $date;
		}

		/**
		 * @param string         $interval one of the INTERVAL_* class constants
		 * @param \DateTime|null $date
		 *
		 * @return \DateTime
		 */
		public static function endOf($interval, \DateTime $date = null) {
			$date = $date ?: new \DateTime();

			switch ($interval) {
				case self::INTERVAL_MINUTE:
					$date->setTime((int)$date->format('H'), (int)$date->format('i'), 59, 999999);

					break;

				case self::INTVERAL_HOUR:
					$date->setTime((int)$date->format('H'), 59, 59, 999999);

					break;

				case self::INTERVAL_DAY:
					$date->setTime(23, 59, 59, 999999);

					break;

				case self::INTERVAL_WEEK:
					$date
						->add(new \DateInterval('P' . (6 - (int)$date->format('w')) . 'D'))
						->setTime(23, 59, 59, 999999);

					break;

				case self::INTERVAL_MONTH:
					$date
						->add(new \DateInterval('P1M'))
						->sub(new \DateInterval('P' . (int)$date->format('d') . 'D'))
						->setTime(23, 59, 59, 999999);

					break;

				case self::INTERVAL_YEAR:
					$date
						->setDate((int)$date->format('Y'), 12, 31)
						->setTime(23, 59, 59, 999999);

					break;

				default:
					throw new \InvalidArgumentException('$interval must be one of the INTERVAL_* class constants');
			}

			return $date;
		}

		/**
		 * @param \DateTime|null $date
		 *
		 * @return \DateTime
		 */
		public static function withoutMicroseconds(\DateTime $date = null) {
			if (!$date)
				$date = new \DateTime();

			return $date->setTimestamp($date->getTimestamp());
		}
	}