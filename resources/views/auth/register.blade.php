@extends('layouts.app')

@section('content')
<v-layout>
  <v-flex xs12 sm4 offset-sm4>
    <v-card>
      <v-flex class="pa-3">
        <h3 class="display-1 text-center mb-4">Register</h3>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p class="body-1 red--text">{{ $error }}</p>
        @endforeach
        @endif
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <v-text-field name="name" value="{{ old('name') }}" label="Name"></v-text-field>
          <v-text-field name="email" value="{{ old('email') }}" label="Email"></v-text-field>
          <v-text-field type="password" name="password" label="Password"></v-text-field>
          <v-text-field type="password" name="password_confirmation" label="Confirm Password"></v-text-field>
          <v-btn type="submit" primary large>Register</v-btn>
        </form>
      </v-flex>
    </v-card>
  </v-flex>
</v-layout>
@endsection
