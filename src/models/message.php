<?php
namespace ChatApp\models;
final class message extends \Illuminate\Database\Eloquent\Model
{
  protected $fillable = ['text' , 'sender'];
}
