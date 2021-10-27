<?php

	namespace sam0hack\Distributor;

	use Illuminate\Routing\Controller;

	class DistributorController extends Controller
	{
		private $users_set = [];
		private $users_levels = [];
		private $level_count = 1;

		/**
		 * @param $user_id
		 * @return array
		 */
		public function downLevels($user_id)
		{

			$code = Distributor::getCode($user_id);
			if ($code != false) {

				$used_codes = Distributor::where('code', $code)->where('user_id', '!=', $user_id)->get();

				foreach ($used_codes as $used_code) {

					array_push($this->users_set, $used_code->user_id);

					$this->downLevels($used_code->user_id);

				}

			}

			return $this->users_set;
		}


		public function levels($user_id)
		{
			$l1 = [];
			$l2 = [];
			$l3 = [];
			$l4 = [];
			$l5 = [];
			$l6 = [];
			$level_one = DistributorLevelOne::where('user_id', $user_id)->get();

			foreach ($level_one as $value) {

				if (!in_array($value->level_user_id, $l1)) {
					array_push($l1, $value->level_user_id);
				}
			}
			array_push($this->users_levels, array('level_1' => $l1));


			$level_two = DistributorLevelTwo::where('user_id', $user_id)->get();
			foreach ($level_two as $value) {

				if (!in_array($value->level_user_id, $l1)) {
					array_push($l1, $value->level_user_id);
					array_push($l2, $value->level_user_id);
				}
			}

			array_push($this->users_levels, array('level_2' => $l2));


			$level_three = DistributorLevelThree::where('user_id', $user_id)->get();
			foreach ($level_three as $value) {

				if (!in_array($value->level_user_id, $l1)) {
					array_push($l1, $value->level_user_id);
					array_push($l3, $value->level_user_id);
				}
			}

			array_push($this->users_levels, array('level_3' => $l3));


			$level_four = DistributorLevelFour::where('user_id', $user_id)->get();
			foreach ($level_four as $value) {

				if (!in_array($value->level_user_id, $l1)) {
					array_push($l1, $value->level_user_id);
					array_push($l4, $value->level_user_id);
				}
			}

			array_push($this->users_levels, array('level_4' => $l4));


			$level_five = DistributorLevelFive::where('user_id', $user_id)->get();
			foreach ($level_five as $value) {

				if (!in_array($value->level_user_id, $l1)) {
					array_push($l1, $value->level_user_id);
					array_push($l5, $value->level_user_id);
				}
			}

			array_push($this->users_levels, array('level_5' => $l5));

			$level_six = DistributorLevelSix::where('user_id', $user_id)->get();
			foreach ($level_six as $value) {

				if (!in_array($value->level_user_id, $l1)) {
					array_push($l1, $value->level_user_id);
					array_push($l6, $value->level_user_id);
				}
			}

			array_push($this->users_levels, array('level_6' => $l6));

			return $this->users_levels;
		}


	}
