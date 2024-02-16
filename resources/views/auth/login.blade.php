@extends('layouts.app')

@section('content')
   
<div class="flex justify-center items-center ">
    <div class="bg-white shadow-md rounded-lg p-8" style="width: 500px; margin-top:8%;">
    <img src="{{asset('img/LikeSMS.png') }}" alt="" style="width: 400px;">
        <div class="flex justify-center">
            <h1 class="text-2xl font-bold mt-6">¡Bienvenido!</h1>

        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-8">
                <label for="email" class="block font-medium text-gray-700 font-bold text-xl">Correo</label>
                <input id="email" type="text" name="email" value="{{ old('email') }}"  required autofocus
                    class="block w-full mt-1 px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-[#018571] sm:text-sm @error('technical_number') border-red-500 @enderror" placeholder="ingrese su correo">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-gray-700 font-bold text-xl">Contraseña</label>
                <input id="password" type="password" name="password" required
                    class="block w-full mt-1 px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-[#018571 ] sm:text-sm @error('password') border-red-500 @enderror" placeholder="ingrese su contraseña">
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-gray-300 text-[#0172C2] shadow-sm focus:ring-[#0172C2]">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recordar contraseña') }}</span>
                </label>
            </div>

            <div class="flex items-center mt-20">
                <button type="submit" class="w-full items-center px-4 py-2 border border-transparent rounded-md font-semibold text-sm text-white bg-[#018571] hover:bg-[#015C4F] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-center">
                    INICIAR SESIÓN
                </button>
            </div>
        </form>
    </div>
</div>

@endsection