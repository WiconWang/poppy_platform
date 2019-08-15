<?php

namespace App\Bean;

/**
 * 超级管理员总表
 * Class AdminBean
 * Create With Automatic Generator
 * @property int id |
 * @property string username | 用户昵称
 * @property string mobile | 用户手机号
 * @property string email | 用户邮箱
 * @property string password | 登陆密码
 * @property string photo | 头像
 * @property int status | 用户状态 0正常 1禁用
 * @property mixed last_login | 最后登陆时间
 * @property mixed created_at |
 * @property mixed updated_at |
 */
class AdminBean extends \EasySwoole\Spl\SplBean
{
	protected $id;

	protected $username;

	protected $mobile;

	protected $email;

	protected $password;

	protected $photo;

	protected $status;

	protected $last_login;

	protected $created_at;

	protected $updated_at;


	public function setId($id)
	{
		$this->id = $id;
	}


	public function getId()
	{
		return $this->id;
	}


	public function setUsername($username)
	{
		$this->username = $username;
	}


	public function getUsername()
	{
		return $this->username;
	}


	public function setMobile($mobile)
	{
		$this->mobile = $mobile;
	}


	public function getMobile()
	{
		return $this->mobile;
	}


	public function setEmail($email)
	{
		$this->email = $email;
	}


	public function getEmail()
	{
		return $this->email;
	}


	public function setPassword($password)
	{
		$this->password = $password;
	}


	public function getPassword()
	{
		return $this->password;
	}


	public function setPhoto($photo)
	{
		$this->photo = $photo;
	}


	public function getPhoto()
	{
		return $this->photo;
	}


	public function setStatus($status)
	{
		$this->status = $status;
	}


	public function getStatus()
	{
		return $this->status;
	}


	public function setLastLogin($last_login)
	{
		$this->last_login = $last_login;
	}


	public function getLastLogin()
	{
		return $this->last_login;
	}


	public function setCreatedAt($created_at)
	{
		$this->created_at = $created_at;
	}


	public function getCreatedAt()
	{
		return $this->created_at;
	}


	public function setUpdatedAt($updated_at)
	{
		$this->updated_at = $updated_at;
	}


	public function getUpdatedAt()
	{
		return $this->updated_at;
	}
}

