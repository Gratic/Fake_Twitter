<?php
class UserController
{
	public function userInscriptionForm()
	{
		view('userInscription-form');
	}

	public function userAdd()
	{
		$user_name = $_POST['user_name'];
		$user_password = $_POST['user_password'];
		$user_password_confirmation = $_POST['user_password_confirmation'];

		if($user_password !== $user_password_confirmation)
		{
			flash('erreur', 'Vos mots de passe ne correspondent pas !');
			redirect('inscription');
		}

		$user_password = password_hash($user_password, PASSWORD_BCRYPT);

		$user = User::getUserWithName($user_name);
		if($user)
		{
			flash('erreur', 'Cet utilisateur existe déjà !');
			redirect('inscription');
		}
		else
		{
			$user = new User();
			$user->user_name = $user_name;
			$user->user_password = $user_password;
			$user->create();
			
			$user = User::getUserWithName($user_name);

			Auth::authentificate($user->user_id);

			flash('succes', 'Vous êtes des nôtres maitenant. Bienvenue !');
			redirect('timeline');
		}
	}

	public function userConnexionForm()
	{
		view('userConnexion-form');
	}

	public function userConnexion()
	{
		$user_name = $_POST['user_name'];
		$user_password = $_POST['user_password'];

		$user = User::getUserWithName($user_name);

		if(password_verify($user_password, $user->user_password))
		{
			Auth::authentificate($user->user_id);
			flash('succes', 'Vous êtes connecté.');
			redirect("timeline");
		}
		else
		{
			flash('erreur', 'Une erreur s\'est produite. Est-ce que vos informations sont correctes ?');
			redirect("connexion");
		}
	}

	public function userDeconnexion()
	{
		Auth::deauthentificate();
		flash('succes', 'Vous êtes déconnecté.');
		redirect("timeline");
	}

	public function userAll()
	{
		$users = User::all();
		view('users-list', ['users' => $users]);
	}

	public function userDelete()
	{
		$user_id = $_GET['user_id'];
		
		User::destroy($user_id);

		redirect('users-list');
	}
}