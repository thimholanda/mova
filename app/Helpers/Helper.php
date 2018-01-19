<?php

	namespace App\Helpers;
	use Illuminate\Support\Str;
	use Carbon\Carbon;

	class Helper
	{
		public static function arg()
		{
			return 'Arrrrrg!';
		}

		public static function getFirstLast($str)
		{
			$ar = explode(' ', $str);
			$first = array_shift($ar);
			$last = array_pop($ar);
			return $first . ' ' . $last;
		}

		public static function getFirstSecond($str)
		{
			$ar = explode(' ', $str);

			if(count($ar) > 1)
			{
				$first = array_shift($ar);
				$second = $ar[0];
				$last = array_pop($ar);
				return $first . ' ' . $second;
			}

			else
			{
				$first = $ar[0];				
				return ucwords($first);
			}

			
		}

		public static function getCurrentRole($roles)
		{
			foreach ($roles as $role) 
			{
				switch ($role->description) 
				{
					case 'admin':
						return '(admin)';
						break;

					case 'produtor':
						return '(produtor)';
						break;

					case 'usuario':
						return '';
						break;					
				}

			}
		}

		public static function getFirstLetter($str)
		{
			return substr ( $str , 0, 1 );
		}

		public static function dateJs($date)
		{
			$date = \DateTime::createFromFormat('Y-m-d H:i:s', $date);

			$objDate = new \StdClass;
			$objDate->Y = $date->format("Y");
			$objDate->d = $date->format("d");
			$objDate->m = $date->format("m");
			$objDate->H = $date->format("H");
			$objDate->i = $date->format("i");
			$objDate->s = $date->format("s");

			return $objDate;
		}

		public static function strUpper($str)
		{
			return Str::upper($str);
		}

		public static function dateFormat($str)
		{
			$date = Carbon::createFromFormat('Y-m-d', $str);

			return $date->format('d/m/Y');
		}

		public static function dateTimeCreate($str)
		{
			$date = Carbon::createFromFormat('Y-m-d H:i:s', $str);

			return $date;
		}

		public static function getUserName($id)
		{
			$user = \App\User::find($id);
			return $user->name;
		}

		public static function price($str)
		{
			return str_replace('.', ',', $str);
		}

	}