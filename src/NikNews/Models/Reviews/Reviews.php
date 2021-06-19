<?php

namespace NikNews\Models\Reviews;

use NikNews\Models\Reviews\ReviewsEntity;

class Reviews extends ReviewsEntity
{
	protected $guestName;

	protected $createAt;

	protected $mail;

	protected $reviewText;

	protected $status;

	protected static function getTableName(): string
	{
		return 'reviews_list';
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->guestName;
	}

	public function getDate(): string
	{
		return $this->createAt;
	}

	public function getEmail(): string
	{
		return $this->mail;
	}

	public function getText(): string
	{
		return $this->reviewText;
	}

	public function getStatus(): int
	{
		return $this->status;
	}

	public function setAuthor(string $author)
	{
		$this->guest_name = $author;
	}

	public function setMail(string $mail)
	{
		$this->mail = $mail;
	}

	public function setText(string $text)
	{
		$this->review_text = strip_tags($text);//strip_tags - удаляет html теги перед отправкой в базу данных если они были введены
	}

	public static function createFromArray(array $fields): Reviews
	{
		$reviews = new Reviews ();
		$reviews->setAuthor($fields['author']);
		$reviews->setMail($fields['mail']);
		$reviews->setText($fields['reviewText']);

		$reviews->save();

		return $reviews;
	}

	public function updateFromArray(array $fields): Reviews
	{
		$this->setAuthor($fields['author']);
		$this->setMail($fields['mail']);
		$this->setText($fields['reviewText']);
		
		$this->save();
		return $this;
	}

}