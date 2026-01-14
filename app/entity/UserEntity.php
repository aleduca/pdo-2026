<?php

namespace app\entity;

class UserEntity
{
	protected ?int $id = null;
	protected ?string $firstName = null;
	protected ?string $lastName = null;
	protected ?string $email = null;
	protected ?string $password = null;
	protected ?string $image = null;
	protected ?string $created_at = null;
	protected ?string $updated_at = null;

	public function getId(): ?int
	{
		return $this->id ?? null;
	}

	public function getFirstName(): ?string
	{
		return $this->firstName ?? null;
	}

	public function getLastName(): ?string
	{
		return $this->lastName ?? null;
	}

	public function getEmail(): ?string
	{
		return $this->email ?? null;
	}

	public function getPassword(): ?string
	{
		return $this->password ?? null;
	}

	public function getImage(): ?string
	{
		return $this->image ?? null;
	}

	public function getCreated_at(): ?string
	{
		return $this->created_at ?? null;
	}

	public function getUpdated_at(): ?string
	{
		return $this->updated_at ?? null;
	}

	public function setId(?int $id): self
	{
		$this->id = $id;

		return $this;
	}

	public function setFirstName(?string $firstName): self
	{
		$this->firstName = $firstName;

		return $this;
	}

	public function setLastName(?string $lastName): self
	{
		$this->lastName = $lastName;

		return $this;
	}

	public function setEmail(?string $email): self
	{
		$this->email = $email;

		return $this;
	}

	public function setPassword(?string $password): self
	{
		$this->password = $password;

		return $this;
	}

	public function setImage(?string $image): self
	{
		$this->image = $image;

		return $this;
	}

	public function setCreated_at(?string $created_at): self
	{
		$this->created_at = $created_at;

		return $this;
	}

	public function setUpdated_at(?string $updated_at): self
	{
		$this->updated_at = $updated_at;

		return $this;
	}

	public function fullName()
	{
		return $this->firstName . ' ' . $this->lastName;
	}
}
