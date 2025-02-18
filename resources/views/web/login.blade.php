@extends('web.admin.layouts.master')

@section('title', 'Login')

@section('content')

    <div class="relative flex flex-col rounded-xl bg-transparent">
        <h4 class="block text-xl font-medium text-slate-800">
            Sign in
        </h4>
        <p class="font-light text-slate-500">
            Welcome back. Check your monitors first hand
        </p>
        <form action="{{ route('sign-in') }}" method="POST" class="mb-2 mt-8 w-80 max-w-screen-lg sm:w-96">
            @csrf
            <div class="mb-1 flex flex-col gap-6">
                <div class="w-full min-w-[200px] max-w-sm">
                    <label class="mb-2 block text-sm text-slate-600">
                        Email
                    </label>
                    <input type="email" name="email"
                        class="ease w-full rounded-md border border-slate-200 bg-transparent px-3 py-2 text-sm text-slate-700 shadow-sm transition duration-300 placeholder:text-slate-400 hover:border-slate-300 focus:border-slate-400 focus:shadow focus:outline-none"
                        placeholder="Your Email" />
                </div>
                <div class="w-full min-w-[200px] max-w-sm">
                    <label class="mb-2 block text-sm text-slate-600">
                        Password
                    </label>
                    <input type="password" name="password"
                        class="ease w-full rounded-md border border-slate-200 bg-transparent px-3 py-2 text-sm text-slate-700 shadow-sm transition duration-300 placeholder:text-slate-400 hover:border-slate-300 focus:border-slate-400 focus:shadow focus:outline-none"
                        placeholder="Your Password" />
                </div>
            </div>
            <button
                class="mt-4 w-full rounded-md border border-transparent bg-slate-800 px-4 py-2 text-center text-sm text-white shadow-md transition-all hover:bg-slate-700 hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="submit">
                Sign in
            </button>
        </form>
    </div>

@endsection
