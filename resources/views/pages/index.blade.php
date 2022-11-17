@extends('layouts.app')

<nav id = "info">
  <a href="{{ route('faq') }}">FAQ</a>
  <a href="{{ route('about') }}">About</a>
  <a href="{{ route('contacts') }}">Contacts</a>
</nav>
<button id="loginInitial"><a href="{{ route('login') }}" id = "initial_login">LOGIN</a></button>
