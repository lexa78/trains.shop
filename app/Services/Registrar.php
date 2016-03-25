<?php namespace App\Services;

use App\Models\Firm;
use App\Models\Role;
use App\Models\User;
use DB;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|alpha_spaces_numbers_etc|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:8',
            'full_organisation_name' => 'required|alpha_spaces_numbers_etc|max:255',
            'organisation_name' => 'required|alpha_spaces_numbers_etc|max:255',
            'okpo' => 'required|only_numbers_like_string|max:10|min:10',
            'ogrn' => 'required|only_numbers_like_string|max:13|min:13',
            'inn' => 'required|only_numbers_like_string|max:10|min:10',
            'kpp' => 'required|only_numbers_like_string|max:9|min:9',
            'rs' => 'required|only_numbers_like_string|max:20|min:20',
            'bik' => 'required|only_numbers_like_string|max:9|min:9',
            'bank' => 'required|alpha_spaces_numbers_etc|max:255',
            'ks' => 'required|only_numbers_like_string|max:20|min:20',
            'face_position' => 'required|alpha_spaces_numbers_etc|max:255',
            'face_fio' => 'required|alpha_spaces_numbers_etc|max:255',
            'base_document' => 'required|alpha_spaces_numbers_etc|max:255',
            'place_address' => 'required|alpha_spaces_numbers_etc|max:255',
            'post_address' => 'required|alpha_spaces_numbers_etc|max:255',
            'contact_face_fio' => 'required|alpha_spaces_numbers_etc|max:255',
            'phone' => 'required|alpha_spaces_numbers_etc|max:100',
//            'oferta' => 'accepted',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
        $user = null;
        DB::transaction(function()
            use($data, &$user)
        {
            $firm = new Firm();
            $firm->full_organisation_name = $data['full_organisation_name'];
            $firm->organisation_name = $data['organisation_name'];
            $firm->okpo = $data['okpo'];
            $firm->ogrn = $data['ogrn'];
            $firm->inn = $data['inn'];
            $firm->kpp = $data['kpp'];
            $firm->rs = $data['rs'];
            $firm->bik = $data['bik'];
            $firm->bank = $data['bank'];
            $firm->ks = $data['ks'];
            $firm->face_position = $data['face_position'];
            $firm->face_fio = $data['face_fio'];
            $firm->base_document = $data['base_document'];
            $firm->place_address = $data['place_address'];
            $firm->post_address = $data['post_address'];
            $firm->contact_face_fio = $data['contact_face_fio'];
            $firm->phone = $data['phone'];
            $firm->save();
//            $user = User::create([
//                'name' => $data['name'],
//                'email' => $data['email'],
//                'password' => bcrypt($data['password']),
//                'firm_id' => $firm->id,
//                'role_id' => Role::CLIENT
//            ]);
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->firm_id = $firm->id;
            $user->role_id = Role::CLIENT;
            $user->save();
        });
        return $user;
	}

}
