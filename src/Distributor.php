<?php


	namespace sam0hack\Distributor;

	use Exception;
	use Illuminate\Database\Eloquent\Model;


	class Distributor extends Model
	{
		protected $guarded = [];


		/**
		 * add_distributor
		 * @param $user_id
		 * @param $referral_code
		 * @return bool
		 */
		public static function add_distributor($user_id, $referral_code)
		{
			// Limit from Settings Table

			$limit = DistributorSetting::getLimit();
			$referral_code_user = 0;
			try {

				//skip if this user id already registered with code
				$check = Distributor::where('user_id', $user_id)->first();

				if (!empty($check->id)) {
					return false;
					//return 'error code 9851';
				}

				//Get count of the current used referral codes
				$current_count = Distributor::where('code', $referral_code)->count();
				if ($current_count < $limit) {
					Distributor::create(['user_id' => $user_id, 'code' => $referral_code]);
					DistributorCode::createUserCode($user_id);
					DistributorLevel::levelMaker($user_id, $referral_code);

					$referral_code = DistributorCode::where('referral_code', $referral_code)->first();
					self::add_multi_levels($referral_code->user_id, $user_id);
					$referral_code_user = $referral_code;

				} else {
					// if user limit is full assign this user to another user which is in under current user
					$distributors = Distributor::where('code', $referral_code)->get();


					foreach ($distributors as $distributor):

						$code = DistributorCode::where('user_id', $distributor->user_id)->first();


						$next_count = Distributor::where('code', $code->referral_code)->count();

						if ($next_count < $limit) {

							Distributor::create(['user_id' => $user_id, 'code' => $code->referral_code]);
							DistributorLevel::levelMaker($user_id, $code->referral_code);
							DistributorCode::createUserCode($user_id);
							self::add_multi_levels($code->user_id, $user_id);
							$referral_code_user = $code;
							break;
						}
						$next_count = 0;
						$code = 0;
					endforeach;
					//@todo if all users limit is full add this user under to admin/Super level users

				}

				return $referral_code_user->user_id;
			} catch (Exception $e) {
				return dd($e);
			}
		}

		public static function add_multi_levels($referred_by, $user_id)
		{

			//Level One can only have limited number of users as defined in the settings
			$limit = DistributorSetting::getLimit();


			$referral_counts = DistributorLevelOne::where('user_id', $user_id)->get();

			if (count($referral_counts) <= $limit) {

				//Add this user into referrals level one

				$check = DistributorLevelOne::CheckForDuplicate($referred_by, $user_id);

				if ($check !== false) {

					DistributorLevelOne::create(['user_id' => $referred_by, 'level_user_id' => $user_id]);
				}

				//Get this referrals upper levels
				$upper_levels = DistributorLevel::where('distributed_by', $referred_by)->first();


				//Add this user into referral's upper level.
				//So this user will be on the level2 of the referral's upper level and so on
				$check = DistributorLevelTwo::CheckForDuplicate($referred_by, $user_id);

				if ($check !== false) {

					DistributorLevelTwo::create(['user_id' => $upper_levels->level_1, 'level_user_id' => $user_id]);
				}

				$check = DistributorLevelThree::CheckForDuplicate($referred_by, $user_id);

				if ($check !== false) {

					DistributorLevelThree::create(['user_id' => $upper_levels->level_2, 'level_user_id' => $user_id]);
				}

				$check = DistributorLevelFour::CheckForDuplicate($referred_by, $user_id);

				if ($check !== false) {

					DistributorLevelFour::create(['user_id' => $upper_levels->level_3, 'level_user_id' => $user_id]);
				}

				$check = DistributorLevelFive::CheckForDuplicate($referred_by, $user_id);

				if ($check !== false) {

					DistributorLevelFive::create(['user_id' => $upper_levels->level_4, 'level_user_id' => $user_id]);
				}

//            $check = DistributorLevelSix::CheckForDuplicate($referred_by, $user_id);
//
//            if ($check !== false) {
//
//                DistributorLevelSix::create(['user_id' => $upper_levels->level_5, 'level_user_id' => $user_id]);
//            }
			} else {
				//Skip

			}

		}

		/**
		 * Check if user exits
		 * @param $user_id
		 * @return bool
		 */
		public static function checkIfUserLevelExists($user_id)
		{

			$exists = DistributorLevel::where('distributed_by', $user_id)->first();

			if ($exists === null) {
				return false;
			} else {
				return true;
			}

		}


		public static function getRandomGenZeroCode()
		{
			try {
				$r = rand(1, 6);
				$code = DistributorCode::where('user_id', $r)->first();
				return $code->referral_code;
			} catch (Exception $e) {
				return $e;
			}
		}

		/**
		 * get User code
		 * @param $user_id
		 * @return boolean
		 */
		public static function getCode($user_id)
		{

			try {
				$code = DistributorCode::where('user_id', $user_id)->first();
				return $code->referral_code;
			} catch (Exception $e) {
				return false;
			}

		}

		private static function code_count($limit, $referral_code)
		{
			$current_count = Distributor::where('code', $referral_code)->count();

			if (!empty($current_count)) {
				if ($current_count < $limit) {
					return true;
				} else {
					return false;
				}

			}
			return false;
		}

		public function getCodeUser()
		{
			$this->hasOne('src\DistributorCode', 'referral_code', 'code');
		}

	}
